<?php

namespace Database\Factories;

use App\Models\Nota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class NotaFactory extends Factory
{
    protected $model = Nota::class;

    public function definition(): array
    {
        return [
            'user_id'=> User::factory(),
            'titulo' => fake()->word(),
            'contenido' => fake()->sentence,
            'fecha_creacion' => fake()->dateTimeBetween('-50 years', '1 year'),
            'color' => fake()->hexColor,
        ];
    }

}
