<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AdmissionAtach;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmissionAtachPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admissionAtach can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list admissionataches');
    }

    /**
     * Determine whether the admissionAtach can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AdmissionAtach  $model
     * @return mixed
     */
    public function view(User $user, AdmissionAtach $model)
    {
        return $user->hasPermissionTo('view admissionataches');
    }

    /**
     * Determine whether the admissionAtach can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create admissionataches');
    }

    /**
     * Determine whether the admissionAtach can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AdmissionAtach  $model
     * @return mixed
     */
    public function update(User $user, AdmissionAtach $model)
    {
        return $user->hasPermissionTo('update admissionataches');
    }

    /**
     * Determine whether the admissionAtach can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AdmissionAtach  $model
     * @return mixed
     */
    public function delete(User $user, AdmissionAtach $model)
    {
        return $user->hasPermissionTo('delete admissionataches');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AdmissionAtach  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete admissionataches');
    }

    /**
     * Determine whether the admissionAtach can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AdmissionAtach  $model
     * @return mixed
     */
    public function restore(User $user, AdmissionAtach $model)
    {
        return false;
    }

    /**
     * Determine whether the admissionAtach can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\AdmissionAtach  $model
     * @return mixed
     */
    public function forceDelete(User $user, AdmissionAtach $model)
    {
        return false;
    }
}
