<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Puesto;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puestos = [
            ['puesto' => 'Chofer', 'cantidad_bono_x_hora' => 10],
            ['puesto' => 'Cargador', 'cantidad_bono_x_hora' => 5],
            ['puesto' => 'Auxiliar', 'cantidad_bono_x_hora' => 0],
        ];

        $now = now();

        foreach ($puestos as $puesto) {
            $puesto['created_at'] = $now;
            $puesto['updated_at'] = $now;
        }

        Puesto::insert($puestos);
    }
}
