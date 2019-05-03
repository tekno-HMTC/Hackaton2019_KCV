<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\User;
use App\Skor;
use App\Soal;
use App\Jawaban;

class RoomController extends Controller
{
    public  function  index($id_room){

    }

    public function create(){

    }

    public function store(Request $request){

        $user = new User();
        $user->username = 'master';
        $user->save();

        $room = new Room();
        $room->master_id = $user->id;
        $room->status = 0;
        $room->kode = $request->kode;
        $room->player_id = implode('|', array());
        $room->save();
        $room->kode = $room->id.'_'.$room->kode;
        $room->save();

        return redirect()->route('soal')->with([
            'id_room' => $room->kode
        ]);
    }

    public function soal($id_room){

    }

    public function addSoal(Request $request, $id_room){
        $room = Room::all()->where('kode', $id_room);
        $room->paket_id = implode('|', $request->paket_id);
        $room->save();

        return redirect()->route('room', ['id_room' => $room->kode])->with([
            'id_room' => $room->kode,
            'master' => 1
        ]);
    }

    public function start(Request $request, $id_room){
        $room = Room::all()->where('kode', $id_room);
        $room->status = 1;
        //broadcast
        $room->save();
    }

    public function scoreboard($id_room){
        $skors = Skor::all()->where('room_id', $id_room);
        $current_skor = array_map(function($skor) {return array(User::find($skor->user_id)->username => (int)$skor->skor);}, $skors);
        arsort($current_skor);
        $data = $current_skor;
        return view('scoreboard', compact('data'));
    }

    public function submit(Request $request){
        $jawaban = new Jawaban();
        $jawaban->soal_id = $request->soal_id;
        $jawaban->user_id = $request->user_id;
        $jawaban->jawaban = $request->jawaban;
        $jawaban->save();
        $this->updateScoreBoard($request);
        //broadcast
    }

    private function updateScoreBoard($request){
        $soal = Soal::all()->find($request->soal_id);
        $score = 0;
        if($request->jawaban == $soal->jawaban){
            $remaining_time = 300 - $request->elapsed_time;
            $percentage = $remaining_time/300;
            $score = 100 * $percentage;
        }
        $skor = $this->checkIfScoreExisted($request->room_id, $request->user_id);
        if(!$skor){
            $skor = new Skor();
            $skor->user_id = $request->user_id;
            $skor->room_id = $request->room_id;
            $skor->skor_user = 0;
        }
        $skor->skor_user = $skor->skor_user + $score;

    }

    private function checkIfScoreExisted($room_id, $user_id){
        $score = Skor::all()->where('room_id', $room_id)->where('user_id', $user_id);
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
}
