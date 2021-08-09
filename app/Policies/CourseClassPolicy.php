<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CourseClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the courseClass can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list courseclasses');
    }

    /**
     * Determine whether the courseClass can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClass  $model
     * @return mixed
     */
    public function view(User $user, CourseClass $model)
    {
        return $user->hasPermissionTo('view courseclasses');
    }

    /**
     * Determine whether the courseClass can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create courseclasses');
    }

    /**
     * Determine whether the courseClass can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClass  $model
     * @return mixed
     */
    public function update(User $user, CourseClass $model)
    {
        return $user->hasPermissionTo('update courseclasses');
    }

    /**
     * Determine whether the courseClass can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClass  $model
     * @return mixed
     */
    public function delete(User $user, CourseClass $model)
    {
        return $user->hasPermissionTo('delete courseclasses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClass  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete courseclasses');
    }

    /**
     * Determine whether the courseClass can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClass  $model
     * @return mixed
     */
    public function restore(User $user, CourseClass $model)
    {
        return false;
    }

    /**
     * Determine whether the courseClass can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClass  $model
     * @return mixed
     */
    public function forceDelete(User $user, CourseClass $model)
    {
        return false;
    }
}
