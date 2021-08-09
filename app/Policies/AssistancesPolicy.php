<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Assistances;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssistancesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the assistances can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allassistances');
    }

    /**
     * Determine whether the assistances can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assistances  $model
     * @return mixed
     */
    public function view(User $user, Assistances $model)
    {
        return $user->hasPermissionTo('view allassistances');
    }

    /**
     * Determine whether the assistances can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allassistances');
    }

    /**
     * Determine whether the assistances can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assistances  $model
     * @return mixed
     */
    public function update(User $user, Assistances $model)
    {
        return $user->hasPermissionTo('update allassistances');
    }

    /**
     * Determine whether the assistances can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assistances  $model
     * @return mixed
     */
    public function delete(User $user, Assistances $model)
    {
        return $user->hasPermissionTo('delete allassistances');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assistances  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allassistances');
    }

    /**
     * Determine whether the assistances can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assistances  $model
     * @return mixed
     */
    public function restore(User $user, Assistances $model)
    {
        return false;
    }

    /**
     * Determine whether the assistances can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Assistances  $model
     * @return mixed
     */
    public function forceDelete(User $user, Assistances $model)
    {
        return false;
    }
}
