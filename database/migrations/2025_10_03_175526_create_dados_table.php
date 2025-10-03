<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dados', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('cpf', 11);
            $table->integer('idade');
            $table->string('cep', 13);
            $table->string('cidade', 100);
            $table->string('estado', 2);
            $table->string('rua', 150);
            $table->string('bairro', 100);
            $table->tinyInteger('ensino_medio');
            $table->string('sexo', 20);
            $table->decimal('salario', 12, 2);
            $table->string('anexo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dados');
    }
};
