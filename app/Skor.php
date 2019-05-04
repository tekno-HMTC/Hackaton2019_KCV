<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skor extends Model
{
    protected $fillable = ['user_id', 'room_id', 'skor_user'];
}
