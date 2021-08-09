<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnrollmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the enrollment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list enrollments');
    }

    /**
     * Determine whether the enrollment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Enrollment  $model
     * @return mixed
     */
    public function view(User $user, Enrollment $model)
    {
        return $user->hasPermissionTo('view enrollments');
    }

    /**
     * Determine whether the enrollment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create enrollments');
    }

    /**
     * Determine whether the enrollment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Enrollment  $model
     * @return mixed
     */
    public function update(User $user, Enrollment $model)
    {
        return $user->hasPermissionTo('update enrollments');
    }

    /**
     * Determine whether the enrollment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Enrollment  $model
     * @return mixed
     */
    public function delete(User $user, Enrollment $model)
    {
        return $user->hasPermissionTo('delete enrollments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Enrollment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete enrollments');
    }

    /**
     * Determine whether the enrollment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Enrollment  $model
     * @return mixed
     */
    public function restore(User $user, Enrollment $model)
    {
        return false;
    }

    /**
     * Determine whether the enrollment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Enrollment  $model
     * @return mixed
     */
    public function forceDelete(User $user, Enrollment $model)
    {
        return false;
    }
}
