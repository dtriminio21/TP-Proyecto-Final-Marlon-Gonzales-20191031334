<?php

namespace Database\Factories;

use App\Models\Etiqueta;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Factories\Factory;

class categoria_notaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nota_id'=>Nota::factory(),
            'etiqueta_id'=>Etiqueta::factory(),
        ];
    }
}
