<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $fillable = ['soals_id', 'users_id', 'jawaban'];
}
