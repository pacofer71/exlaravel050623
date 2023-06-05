<?php

namespace App\Policies;

use App\Models\Foto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FotoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Foto $foto): bool
    {
        return $user->id===$foto->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Foto $foto): bool
    {
        return $user->id===$foto->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Foto $foto): bool
    {
        return $user->id===$foto->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Foto $foto): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Foto $foto): bool
    {
        return true;
    }
}
