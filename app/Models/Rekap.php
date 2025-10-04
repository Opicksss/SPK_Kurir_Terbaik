<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    protected $table = 'rekaps';

    protected $fillable = ['kriteria_id', 'kurir_id', 'nilai', 'date'];

    protected $guarded = ['id'];

    public function kurir()
    {
        return $this->belongsTo(Kurir::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
