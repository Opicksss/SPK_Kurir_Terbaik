<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = ['kode', 'nama', 'sifat', 'bobot'];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class);
    }
}
