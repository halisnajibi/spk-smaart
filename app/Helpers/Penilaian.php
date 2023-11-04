<?php
namespace App\Helpers;

use App\Models\Penilaian;
use App\Models\Perangkingan;

class PenilaianHelp {

    public static function getKriteria($id) {
        $data = Penilaian::where('alternatif_id', $id)->get();
        return $data;
    }

    public static function getMinValueByKriteria($kriteriaId){
        $nilaiMinimum = Penilaian::where('kriteria_id', $kriteriaId)->min('nilai');
        return $nilaiMinimum;
    }

    public static function getMaxValueByKriteria($kriteriaId){
        $nilaiMinimum = Penilaian::where('kriteria_id', $kriteriaId)->max('nilai');
        return $nilaiMinimum;
    }

    public static function getRangking($id) {
        $data = Perangkingan::where('alternatif_id', $id)->get();
        return $data;
    }
}