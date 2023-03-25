<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodos = [
            ['periodo' => '202301'],
            ['periodo' => '202302'],
            ['periodo' => '202303'],
            ['periodo' => '202304'],
            ['periodo' => '202305'],
            ['periodo' => '202306'],
            ['periodo' => '202307'],
            ['periodo' => '202308'],
            ['periodo' => '202309'],
            ['periodo' => '202310'],
            ['periodo' => '202311'],
            ['periodo' => '202312'],
        ];

        $now = now();

        foreach ($periodos as &$periodo) {
            $periodo['created_at'] = $now;
            $periodo['updated_at'] = $now;
        }

        Periodo::insert($periodos);
    }
}
