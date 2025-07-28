<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDnsChecksToClientDomains extends Migration
{
    public function up()
    {
        Schema::table('client_domains', function (Blueprint $table) {
            $table->boolean('mx_valid')->default(false);
            $table->string('mx_message')->nullable();
            $table->boolean('spf_valid')->default(false);
            $table->string('spf_message')->nullable();
            $table->boolean('dkim_valid')->default(false);
            $table->string('dkim_message')->nullable();
            $table->boolean('dmarc_valid')->default(false);
            $table->string('dmarc_message')->nullable();
        });
    }

    public function down()
    {
        Schema::table('client_domains', function (Blueprint $table) {
            $table->dropColumn([
                'mx_valid','mx_message',
                'spf_valid','spf_message',
                'dkim_valid','dkim_message',
                'dmarc_valid','dmarc_message',
            ]);
        });
    }
}
