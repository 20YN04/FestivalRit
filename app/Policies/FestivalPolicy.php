<?php

namespace App\Policies;

use App\Models\Festival;
use App\Models\User;

class FestivalPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Festival $festival): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Festival $festival): bool
    {
        return $festival->user_id === $user->id;
    }

    public function delete(User $user, Festival $festival): bool
    {
        return $festival->user_id === $user->id;
    }
}
