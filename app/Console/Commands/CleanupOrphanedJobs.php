<?php

namespace App\Console\Commands;

use App\Models\JobAction;
use App\Models\JobPost;
use App\Models\User;
use Illuminate\Console\Command;

class CleanupOrphanedJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:cleanup-orphaned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup jobs where the associated locum has deleted their account';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting cleanup of orphaned jobs...');
        
        // Find active jobs where the accepted freelancer data returns N/A
        $activeJobs = JobPost::whereNotIn('job_status', [JobPost::JOB_STATUS_DELETED])
            ->whereIn('job_status', [
                JobPost::JOB_STATUS_OPEN_WAITING,
                JobPost::JOB_STATUS_ACCEPTED,
                JobPost::JOB_STATUS_DONE_COMPLETED,
                JobPost::JOB_STATUS_FREEZED
            ])
            ->get();
        
        $jobIdsToDelete = collect();
        
        foreach ($activeJobs as $job) {
            // Check if this job returns N/A for freelancer data (meaning locum deleted account)
            $freelancerData = $job->getAcceptedFreelancerData();
            
            if ($freelancerData['type'] === 'N/A' || $freelancerData['name'] === 'N/A' || $freelancerData['type'] === 'deleted') {
                $jobIdsToDelete->push($job->id);
                $statusName = $this->getStatusName($job->job_status);
                $this->line("  - Job ID {$job->id}: Status {$statusName}");
            }
        }
        
        if ($jobIdsToDelete->isEmpty()) {
            $this->info('No orphaned jobs found.');
            return Command::SUCCESS;
        }
        
        $this->info("Found {$jobIdsToDelete->count()} jobs with deleted/missing locums.");
        
        // Get affected jobs
        $affectedJobs = JobPost::whereIn('id', $jobIdsToDelete)->get();
        $this->info("Found {$affectedJobs->count()} actual job posts.");
        
        // Show status distribution
        foreach ($affectedJobs->groupBy('job_status') as $status => $jobs) {
            $statusName = $this->getStatusName($status);
            $this->info("  - {$statusName}: {$jobs->count()} jobs");
        }
        
        // Update these jobs to DELETED status (including completed jobs with deleted locums)
        $updatedCount = JobPost::whereIn('id', $jobIdsToDelete)
            ->whereNotIn('job_status', [JobPost::JOB_STATUS_CANCELED, JobPost::JOB_STATUS_DELETED])
            ->update(['job_status' => JobPost::JOB_STATUS_DELETED]);
        
        $this->info("Updated {$updatedCount} jobs to DELETED status.");
        $this->info('Cleanup completed successfully!');
        
        return Command::SUCCESS;
    }
    
    private function getStatusName($status): string
    {
        return match($status) {
            JobPost::JOB_STATUS_OPEN_WAITING => 'WAITING',
            JobPost::JOB_STATUS_ACCEPTED => 'ACCEPTED',
            JobPost::JOB_STATUS_DONE_COMPLETED => 'COMPLETED',
            JobPost::JOB_STATUS_FREEZED => 'FROZEN',
            JobPost::JOB_STATUS_CANCELED => 'CANCELED',
            JobPost::JOB_STATUS_DELETED => 'DELETED',
            JobPost::JOB_STATUS_CLOSE_EXPIRED => 'EXPIRED',
            default => "UNKNOWN ({$status})"
        };
    }
}

