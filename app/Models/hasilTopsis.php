<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hasilTopsis extends Model
{
    protected $table = 'hasil_topsis';

    protected $fillable = [
        'kurir_id',
        'tahun',
        'periode',
        'nilai_preferensi',
        'ranking',
    ];

    public function kurir()
    {
        return $this->belongsTo(Kurir::class);
    }
}
