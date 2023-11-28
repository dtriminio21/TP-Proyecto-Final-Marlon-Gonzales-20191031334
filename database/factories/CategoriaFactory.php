<?php

namespace Database\Factories;

use App\Http\Controllers\CategoriaController;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CategoriaFactory extends Factory
{

    public function definition(): array
    {
        return [
            'nombre' => fake()->word(),
            'user_id' => User::factory(),
        ];
    }
}
