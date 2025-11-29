<?php

namespace App\Policies;

use App\Models\IncomeType;
use App\Models\User;

class IncomeTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin || $user->is_super_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, IncomeType $incomeType): bool
    {
        return $user->is_admin || $user->is_super_admin;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin || $user->is_super_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IncomeType $incomeType): bool
    {
        if (! in_array($incomeType->id, [1, 2], true) && ($user->is_admin || $user->is_super_admin)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IncomeType $incomeType): bool
    {
        if (! in_array($incomeType->id, [1, 2], true) && ($user->is_admin || $user->is_super_admin)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IncomeType $incomeType): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IncomeType $incomeType): bool
    {
        return false;
    }
}
