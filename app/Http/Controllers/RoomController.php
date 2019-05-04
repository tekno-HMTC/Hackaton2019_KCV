<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Skor;
use App\Soal;
use App\Jawaban;
use App\Paket;

class RoomController extends Controller
{
    public  function  index($id_room){
        $room = Room::all()->where('kode', $id_room)->first();
        if($room->status == 0){
            return view('waiting');
        }
        else if($room->status == 1){
            $kumpulan_soal = $this->getAllSoalForRoom($room);
            return view('room.room', compact('kumpulan_soal'))->with([
                'id_room' => $id_room
            ]);
        }
    }

    public function create(){
        $pakets = Paket::all();
        return view('room.create')->with([
            'pakets' => $pakets
        ]);
    }

    public function store(Request $request){
        $user = new User();
        $user->username = 'dummy';
        $user->save();
        $user->username = $user->id.'_'.'master';
        $user->save();

        $id_room = $user->id.'_'.$request->kode;
        $room = new Room();
        $room->paket_id = implode('|', array());
        $room->master_id = $user->id;
        $room->status = 0;
        $room->kode = $id_room;
        $room->player_id = serialize(array());
        $room->save();
        
        return redirect()->route('soal', $room->kode)->with([
            'id_room' => $room->kode
        ]);
    }

    public function soal($id_room){
        $pakets = Paket::all();
        $room = Room::where('kode', $id_room)->first();
        return view('room.soal')->with([
            'id_room' => $id_room,
            'pakets' => $pakets
        ]);
    }

    public function addSoal(Request $request, $id_room){
        if(!is_array($request->paket_id))
            return back();

        $room = Room::all()->where('kode', $id_room)->first();
        $room->paket_id = implode('|', $request->paket_id);
        $room->save();

        return redirect()->route('room', ['id_room' => $room->kode])->with([
            'id_room' => $room->kode,
            'master' => 1
        ]);
    }

    public function soalFromPaketSoal(Request $request){
        $soals = Soal::all()->where('paket_id', $request->paket_id);

    }

    public function start(Request $request, $id_room){
        $room = Room::all()->where('kode', $id_room);
        $room->status = 1;
        //broadcast
        $room->save();
    }

    public function scoreboard($id_room){
        $room = Room::all()->where('kode', $id_room)->first();
        $room_id = $room->id;
        $skors = Skor::where('room_id', $room_id)->orderBy('skor_user', 'desc')->get();
        $current_skor = array();
        foreach($skors as $skor){
            array_push($current_skor, array(User::find($skor->user_id)->username => (int)$skor->skor_user));
        }
        $data = $current_skor;
        return view('scoreboard', compact('data'));
    }

    public function scoreboard_data($id_room){
        $room = Room::all()->where('kode', $id_room)->first();
        $room_id = $room->id;
        $skors = Skor::where('room_id', $room_id)->orderBy('skor_user', 'desc')->get();
        $current_skor = array();
        foreach($skors as $skor){
            array_push($current_skor, array(User::find($skor->user_id)->username => (int)$skor->skor_user));
        }
        $data = $current_skor;
        return compact('data');
    }

    public function submit(Request $request){
        $jawaban = new Jawaban();
        $jawaban->soal_id = $request->soal_id;
        $jawaban->user_id = $request->user_id;
        $jawaban->jawaban = $request->jawaban;
        $jawaban->save();
        $benar = $this->updateScoreBoard($request);
        //broadcast
        return $benar;
    }

    private function updateScoreBoard($request){
        $soal = Soal::all()->find($request->soal_id);
        $score = 0;
        $benar = 0;
        if($request->jawaban == $soal->jawaban){
            $remaining_time = 15 - $request->elapsed_time;
            $percentage = $remaining_time/15;
            $score = 100 * $percentage;
            $benar = 1;
        }
        $room = Room::all()->where('kode', $request->id_room)->first();
        $skor = $this->checkIfScoreExisted($room->id, $request->user_id);
        if(!$skor){
            $skor = new Skor();
            $skor->user_id = $request->user_id;
            $skor->room_id = $room->id;
            $skor->skor_user = 0;
        }
        $skor->skor_user = $skor->skor_user + $score;
        return $benar;
    }

    private function checkIfScoreExisted($room_id, $user_id){
        $score = Skor::all()->where('room_id', $room_id)->where('user_id', $user_id)->first();
        return ($score ? $score : false);
    }

    private function checkIfUserExisted($name){
        $user = User::all()->where('username', $name);
        return ($user ? $name : false);
    }

    private function generateRandomString($length=10){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function getAllSoalForRoom($room){
        $paket_soal = $room->paket_id;
        $paket_soal = explode('|', $paket_soal);
        $kumpulan_soal = array();
        foreach($paket_soal as $paket){
            $kumpulan_soal = array_merge($kumpulan_soal, $this->getSoalFromPaket($paket));
        }
        return $kumpulan_soal;
    }

    private function getSoalFromPaket($id_paket){
        $soals = Soal::all()->where('paket_id', $id_paket);
        $kumpulan_soal = array();
        foreach($soals as $soal){
            array_push($kumpulan_soal, $this->translateSoal($soal));
        }
        return $kumpulan_soal;
    }

    private function translateSoal($soal){
        $translated = array(
            'soal' => $soal->soal,
            'jawaban' => unserialize($soal->pilihan),
            'soal_id' => $soal->id
        );
        return $translated;
    }
}
