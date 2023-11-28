<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
            Schema::create('notas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->string('titulo');
                $table->text('contenido');
                $table->dateTime('fecha_creacion')->default(now());
                $table->string('color')->default(fake()->hexColor);
                $table->timestamps();
            });
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('notas');
    }
};
