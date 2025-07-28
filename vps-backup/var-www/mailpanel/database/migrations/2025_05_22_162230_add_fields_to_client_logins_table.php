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
        Schema::table('client_logins', function (Blueprint $table) {
            $table->unsignedBigInteger('client_domain_id')->after('id');
            $table->string('login')->after('client_domain_id');
            $table->string('maildir')->nullable()->after('login');

            $table->foreign('client_domain_id')
                  ->references('id')
                  ->on('client_domains')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_logins', function (Blueprint $table) {
            $table->dropForeign(['client_domain_id']);
            $table->dropColumn(['client_domain_id', 'login', 'maildir']);

            //
        });
    }
};
