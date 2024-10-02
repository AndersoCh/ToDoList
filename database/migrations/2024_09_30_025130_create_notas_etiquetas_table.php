<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_etiquetas', function (Blueprint $table) {
            $table->unsignedBigInteger('nota_id');
            $table->unsignedBigInteger('etiqueta_id');
    
            // Claves foráneas
            $table->foreign('nota_id')->references('id')->on('notas')->onDelete('cascade');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas_etiquetas');
    }
};
