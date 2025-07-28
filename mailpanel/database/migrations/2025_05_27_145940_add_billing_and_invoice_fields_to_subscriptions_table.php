<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('plan_id');
            $table->integer('billing_day')->default(1)->after('quantity');
            $table->string('razon_social')->after('billing_day');
            $table->string('rut')->after('razon_social');
            $table->string('direccion')->after('rut');
            $table->string('ciudad_region')->after('direccion');
            $table->string('giro')->after('ciudad_region');
            $table->string('contact_email')->nullable()->after('giro');
            $table->string('contact_phone')->nullable()->after('contact_email');
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'quantity',
                'billing_day',
                'razon_social',
                'rut',
                'direccion',
                'ciudad_region',
                'giro',
                'contact_email',
                'contact_phone'
            ]);
        });
    }
};
