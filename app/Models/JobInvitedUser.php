<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobInvitedUser extends Model
{
    use HasFactory;

    const USER_TYPE_LIVE = "live_user";
    const USER_TYPE_PRIVATE = "private_user";

    protected $fillable = [
        'job_post_id',
        'invited_user_id',
        'invited_user_type',
        'acceptance_token',
        'token_expires_at',
    ];

    protected $casts = [
        'token_expires_at' => 'datetime',
    ];

    /**
     * Get the parent invited user model (User or PrivateUser).
     */
    public function invited_user()
    {
        return $this->morphTo();
    }

    public function job()
    {
        return $this->belongsTo(JobPost::class, "job_post_id", "id");
    }

    /**
     * Generate a secure acceptance token
     */
    public function generateAcceptanceToken()
    {
        $token = \Str::random(64);
        $this->update([
            'acceptance_token' => $token,
            'token_expires_at' => now()->addDays(7), // Token expires in 7 days
        ]);
        return $token;
    }

    /**
     * Check if the acceptance token is valid
     */
    public function isTokenValid($token)
    {
        return $this->acceptance_token === $token && 
               $this->token_expires_at && 
               $this->token_expires_at->isFuture();
    }

    /**
     * Clear the acceptance token
     */
    public function clearAcceptanceToken()
    {
        $this->update([
            'acceptance_token' => null,
            'token_expires_at' => null,
        ]);
    }
}