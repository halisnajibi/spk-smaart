<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perangkingan extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(Alternatif::class,'alternatif_id','id');
    }
    public function scopeRankedByHasilAkhir($query)
    {
        return $query->orderBy('hasil_akhir', 'desc');
    }
}
