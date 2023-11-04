<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class,'alternatif_id','id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function hasil()
    {
        return $this->hasOne(HasilSmart::class, 'penilaian_id');
    }
}
