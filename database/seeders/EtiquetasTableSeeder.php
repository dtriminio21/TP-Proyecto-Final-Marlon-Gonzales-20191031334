<?php

namespace Database\Seeders;

use App\Models\Etiqueta;
use Database\Factories\etiquetasFactory;
use Illuminate\Database\Seeder;

class EtiquetasTableSeeder extends Seeder
{
    public function run(): void
    {
        Etiqueta::factory(10)->create();
    }
}
