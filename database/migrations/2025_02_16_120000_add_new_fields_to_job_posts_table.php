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
        Schema::table('job_posts', function (Blueprint $table) {
            $table->string('job_reference')->nullable()->after('job_title');
            $table->time('job_end_time')->nullable()->after('job_start_time');
            $table->unsignedSmallInteger('num_locums_needed')->default(1)->after('job_rate');
            $table->text('special_requirements')->nullable()->after('job_post_desc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropColumn(['job_reference', 'job_end_time', 'num_locums_needed', 'special_requirements']);
        });
    }
};

