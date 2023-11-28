<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categoria_nota', function (Blueprint $table) {
            Schema::dropIfExists('categoria_nota');
            $table->foreignId('nota_id')->constrained('notas')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->primary(['nota_id', 'categoria_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categoria_nota');
    }
};
