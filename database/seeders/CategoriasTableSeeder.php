<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Nota;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::factory(3)->create();
    }
}
