<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    protected $table = 'kurirs';

    protected $fillable = ['kode', 'name', 'alamat', 'nomor', 'tanggal_masuk'];

    protected $guarded = ['id'];

    public function rekaps()
    {
        return $this->hasMany(Rekap::class);
    }
    public function hasilTopsis()
    {
        return $this->hasMany(hasilTopsis::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
