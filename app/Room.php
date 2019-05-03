<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['soals_id', 'master_id', 'player_id', 'status', 'kode'];
    protected $casts = [
        'player_id' => 'array',
    ];
}
