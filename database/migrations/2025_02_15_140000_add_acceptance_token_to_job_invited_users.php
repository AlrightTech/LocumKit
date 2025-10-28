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
        Schema::table('job_invited_users', function (Blueprint $table) {
            $table->string('acceptance_token')->nullable()->after('invited_user_type');
            $table->timestamp('token_expires_at')->nullable()->after('acceptance_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_invited_users', function (Blueprint $table) {
            $table->dropColumn(['acceptance_token', 'token_expires_at']);
        });
    }
};
