<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPerangkingan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function tahun(){
        return $this->belongsTo(Tahun::class);
    }

    public function karyawan(){
        return  $this->belongsTo(Karyawan::class);
    }
}
