<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Admission;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admission can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list admissions');
    }

    /**
     * Determine whether the admission can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Admission  $model
     * @return mixed
     */
    public function view(User $user, Admission $model)
    {
        return $user->hasPermissionTo('view admissions');
    }

    /**
     * Determine whether the admission can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create admissions');
    }

    /**
     * Determine whether the admission can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Admission  $model
     * @return mixed
     */
    public function update(User $user, Admission $model)
    {
        return $user->hasPermissionTo('update admissions');
    }

    /**
     * Determine whether the admission can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Admission  $model
     * @return mixed
     */
    public function delete(User $user, Admission $model)
    {
        return $user->hasPermissionTo('delete admissions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Admission  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete admissions');
    }

    /**
     * Determine whether the admission can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Admission  $model
     * @return mixed
     */
    public function restore(User $user, Admission $model)
    {
        return false;
    }

    /**
     * Determine whether the admission can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Admission  $model
     * @return mixed
     */
    public function forceDelete(User $user, Admission $model)
    {
        return false;
    }
}
