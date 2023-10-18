<?php

namespace App\Charts;

use App\Models\Karyawan;
use App\Models\Tahun;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AlternatifChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
       $label = ['a1-2023','b1-2023'];
        return $this->chart->pieChart()
            ->setTitle('Jumlah Alternatif')
            ->setWidth(350)
            ->setHeight(350)
            ->addData([
                Karyawan::where('tahun_id',1)->count(),
                Karyawan::where('tahun_id',2)->count(),
            ])
            ->setLabels($label);
    }
}
