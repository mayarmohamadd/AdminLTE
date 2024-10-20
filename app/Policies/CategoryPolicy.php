<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    // Only admin can view all categories
    public function viewAny(User $user){
        return $user->role === 'admin';
    }
}
