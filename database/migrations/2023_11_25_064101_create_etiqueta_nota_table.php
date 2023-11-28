<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('etiqueta_nota', function (Blueprint $table) {
            $table->foreignId('nota_id')->constrained('notas')->onDelete('cascade');
            $table->foreignId('etiqueta_id')->constrained('etiquetas')->onDelete('cascade');
            $table->primary(['nota_id', 'etiqueta_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etiqueta_nota');
    }
};
