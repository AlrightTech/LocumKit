<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'assigned_to',
        'resolution_notes',
        'resolved_at',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    // Status constants
    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_CLOSED = 'closed';

    /**
     * Get the admin user assigned to this complaint
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scope to get complaints by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get open complaints
     */
    public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
    }

    /**
     * Scope to get in progress complaints
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    /**
     * Scope to get resolved complaints
     */
    public function scopeResolved($query)
    {
        return $query->where('status', self::STATUS_RESOLVED);
    }

    /**
     * Scope to get closed complaints
     */
    public function scopeClosed($query)
    {
        return $query->where('status', self::STATUS_CLOSED);
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_OPEN => '<span class="badge badge-warning">Open</span>',
            self::STATUS_IN_PROGRESS => '<span class="badge badge-info">In Progress</span>',
            self::STATUS_RESOLVED => '<span class="badge badge-success">Resolved</span>',
            self::STATUS_CLOSED => '<span class="badge badge-secondary">Closed</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge badge-light">Unknown</span>';
    }

    /**
     * Mark complaint as resolved
     */
    public function markAsResolved($notes = null)
    {
        $this->update([
            'status' => self::STATUS_RESOLVED,
            'resolution_notes' => $notes,
            'resolved_at' => now(),
        ]);
    }

    /**
     * Mark complaint as closed
     */
    public function markAsClosed()
    {
        $this->update([
            'status' => self::STATUS_CLOSED,
        ]);
    }

    /**
     * Assign complaint to admin user
     */
    public function assignTo($userId)
    {
        $this->update([
            'assigned_to' => $userId,
            'status' => self::STATUS_IN_PROGRESS,
        ]);
    }
}
