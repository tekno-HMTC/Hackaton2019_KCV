<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public  function create(){
        return view('user');
    }

    public function store(Request $request){
        $user = new User();
        $user->username = $request->username;
        $user->save();

        $room = Room::all()->where('kode', $request->kode_room)->first();
        $current_player = unserialize($room->player_id);
        array_push($current_player, $user->id);
        $room->player_id = serialize($current_player);
        $room->save();
        //broadcast
        return redirect()->route('room', ['id_room' => $room->kode]);
    }

    
}
