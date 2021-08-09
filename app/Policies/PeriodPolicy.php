<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Period;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeriodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the period can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list periods');
    }

    /**
     * Determine whether the period can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Period  $model
     * @return mixed
     */
    public function view(User $user, Period $model)
    {
        return $user->hasPermissionTo('view periods');
    }

    /**
     * Determine whether the period can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create periods');
    }

    /**
     * Determine whether the period can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Period  $model
     * @return mixed
     */
    public function update(User $user, Period $model)
    {
        return $user->hasPermissionTo('update periods');
    }

    /**
     * Determine whether the period can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Period  $model
     * @return mixed
     */
    public function delete(User $user, Period $model)
    {
        return $user->hasPermissionTo('delete periods');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Period  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete periods');
    }

    /**
     * Determine whether the period can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Period  $model
     * @return mixed
     */
    public function restore(User $user, Period $model)
    {
        return false;
    }

    /**
     * Determine whether the period can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Period  $model
     * @return mixed
     */
    public function forceDelete(User $user, Period $model)
    {
        return false;
    }
}
