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
        Schema::table('subscriptions', function (Blueprint $table) {
            // Agrega la columna de prórroga hasta (grace period)
            $table->timestamp('grace_until')
                  ->nullable()
                  ->after('expires_at')
                  ->comment('Fecha límite hasta la que aplica la prórroga de 3 días');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Elimina la columna de prórroga
            $table->dropColumn('grace_until');
        });
    }
};
