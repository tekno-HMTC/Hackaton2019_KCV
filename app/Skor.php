<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skor extends Model
{
    protected $fillable = ['users_id', 'rooms_id', 'skor_user'];
}
