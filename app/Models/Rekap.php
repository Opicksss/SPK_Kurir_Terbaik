<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    protected $table = 'rekaps';

    protected $fillable = ['kriteria_id', 'kurir_id', 'nilai', 'date'];

    protected $guarded = ['id'];
}
