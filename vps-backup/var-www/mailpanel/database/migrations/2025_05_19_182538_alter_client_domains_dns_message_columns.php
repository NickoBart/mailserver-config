<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterClientDomainsDnsMessageColumns extends Migration
{
    public function up()
    {
        // Si tienes doctrine/dbal instalado, puedes usar change():
        // Schema::table('client_domains', function (Blueprint $table) {
        //     $table->text('mx_message')->nullable()->change();
        //     $table->text('spf_message')->nullable()->change();
        //     $table->text('dkim_message')->nullable()->change();
        //     $table->text('dmarc_message')->nullable()->change();
        // });

        // En su lugar, haremos ALTER directamente:
        DB::statement("ALTER TABLE client_domains MODIFY mx_message TEXT NULL");
        DB::statement("ALTER TABLE client_domains MODIFY spf_message TEXT NULL");
        DB::statement("ALTER TABLE client_domains MODIFY dkim_message TEXT NULL");
        DB::statement("ALTER TABLE client_domains MODIFY dmarc_message TEXT NULL");
    }

    public function down()
    {
        // Volvemos a VARCHAR(255) si fuese necesario
        DB::statement("ALTER TABLE client_domains MODIFY mx_message VARCHAR(255) NULL");
        DB::statement("ALTER TABLE client_domains MODIFY spf_message VARCHAR(255) NULL");
        DB::statement("ALTER TABLE client_domains MODIFY dkim_message VARCHAR(255) NULL");
        DB::statement("ALTER TABLE client_domains MODIFY dmarc_message VARCHAR(255) NULL");
    }
}
