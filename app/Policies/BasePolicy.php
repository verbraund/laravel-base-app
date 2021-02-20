<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class BasePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return false;
    }

    public function view(User $user, $model)
    {
        return false;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, $model)
    {
        return false;
    }

    public function delete(User $user, $model)
    {
        return false;
    }

    public function restore(User $user, $model)
    {
        return false;
    }

    public function forceDelete(User $user, $model)
    {
        return false;
    }

}
