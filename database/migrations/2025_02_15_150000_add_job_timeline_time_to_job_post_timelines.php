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
        Schema::table('job_post_timelines', function (Blueprint $table) {
            $table->time('job_timeline_time')->nullable()->after('job_timeline_hrs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_post_timelines', function (Blueprint $table) {
            $table->dropColumn('job_timeline_time');
        });
    }
};
