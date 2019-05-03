<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $fillable = ['soal', 'pilihan', 'jawaban'];
}
