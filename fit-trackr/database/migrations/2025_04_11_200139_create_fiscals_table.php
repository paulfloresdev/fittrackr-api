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
        Schema::create('fiscals', function (Blueprint $table) {
            $table->id();
            $table->string('rfc');
            $table->string('razon_social');
            $table->string('regimen');
            $table->string('uso_cfdi');
            $table->string('cp');
            $table->string('tipo_vialidad');
            $table->string('vialidad');
            $table->integer('num_ext');
            $table->integer('num_int');
            $table->string('colonia');
            $table->string('localidad');
            $table->string('municipio');
            $table->string('estado');
            $table->string('entre_calle');
            $table->string('y_calle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscals');
    }
};
