<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_post_id',
        'job_date_new',
        'job_rate_new',
        'job_timeline_hrs',
        'job_timeline_time',
    ];

    protected $casts = [
        'job_date_new' => 'date',
    ];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
