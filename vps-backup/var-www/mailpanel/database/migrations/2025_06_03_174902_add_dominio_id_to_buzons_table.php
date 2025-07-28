<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDominioIdToBuzonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buzons', function (Blueprint $table) {
            // Agregamos la columna dominio_id que hace FK a dominios.id
            $table->foreignId('dominio_id')
                  ->nullable()
                  ->constrained('dominios')
                  ->onDelete('set null')
                  ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buzons', function (Blueprint $table) {
            $table->dropForeign(['dominio_id']);
            $table->dropColumn('dominio_id');
        });
    }
}
