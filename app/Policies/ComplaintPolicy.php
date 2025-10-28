<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComplaintPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any complaints.
     */
    public function viewAny(User $user)
    {
        return $user->user_acl_role_id == User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can view the complaint.
     */
    public function view(User $user, Complaint $complaint)
    {
        return $user->user_acl_role_id == User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can create complaints.
     */
    public function create(User $user)
    {
        return true; // Anyone can create a complaint via contact form
    }

    /**
     * Determine whether the user can update the complaint.
     */
    public function update(User $user, Complaint $complaint)
    {
        return $user->user_acl_role_id == User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can delete the complaint.
     */
    public function delete(User $user, Complaint $complaint)
    {
        return $user->user_acl_role_id == User::ROLE_ADMIN;
    }
}
