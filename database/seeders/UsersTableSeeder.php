<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $usuario = new User();
        $usuario->name = "David Triminio";
        $usuario->email = "triminio21@gmail.com";
        $usuario->password = 'Diosesfiel.*';
        $usuario->save();
        User::factory(20)->create();
    }
}
