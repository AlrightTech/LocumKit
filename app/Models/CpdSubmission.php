<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpdSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cpd_points',
        'evidence_file_path',
        'submission_date',
        'cycle_start_date',
        'cycle_end_date',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'submission_date' => 'date',
        'cycle_start_date' => 'date',
        'cycle_end_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Get the user who submitted the CPD
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who reviewed the CPD
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Scope to get submissions by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get pending submissions
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope to get approved submissions
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope to get rejected submissions
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Scope to get submissions for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get submissions for current cycle
     */
    public function scopeCurrentCycle($query)
    {
        $now = now();
        return $query->where('cycle_start_date', '<=', $now)
                    ->where('cycle_end_date', '>=', $now);
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_PENDING => '<span class="badge badge-warning">Pending</span>',
            self::STATUS_APPROVED => '<span class="badge badge-success">Approved</span>',
            self::STATUS_REJECTED => '<span class="badge badge-danger">Rejected</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-light">Unknown</span>';
    }

    /**
     * Get evidence file URL
     */
    public function getEvidenceFileUrlAttribute()
    {
        if ($this->evidence_file_path) {
            return asset('storage/' . $this->evidence_file_path);
        }
        return null;
    }

    /**
     * Approve the CPD submission
     */
    public function approve($adminId, $notes = null)
    {
        $this->update([
            'status' => self::STATUS_APPROVED,
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'admin_notes' => $notes,
        ]);
    }

    /**
     * Reject the CPD submission
     */
    public function reject($adminId, $notes = null)
    {
        $this->update([
            'status' => self::STATUS_REJECTED,
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'admin_notes' => $notes,
        ]);
    }

    /**
     * Check if submission is overdue
     */
    public function isOverdue()
    {
        return $this->cycle_end_date < now() && $this->status === self::STATUS_PENDING;
    }

    /**
     * Get total CPD points for user in current cycle
     */
    public static function getTotalPointsForUser($userId, $cycleStart, $cycleEnd)
    {
        return self::where('user_id', $userId)
                   ->where('cycle_start_date', $cycleStart)
                   ->where('cycle_end_date', $cycleEnd)
                   ->where('status', self::STATUS_APPROVED)
                   ->sum('cpd_points');
    }
}
