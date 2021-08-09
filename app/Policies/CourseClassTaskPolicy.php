<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CourseClassTask;
use Illuminate\Auth\Access\HandlesAuthorization;

class CourseClassTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the courseClassTask can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list courseclasstasks');
    }

    /**
     * Determine whether the courseClassTask can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClassTask  $model
     * @return mixed
     */
    public function view(User $user, CourseClassTask $model)
    {
        return $user->hasPermissionTo('view courseclasstasks');
    }

    /**
     * Determine whether the courseClassTask can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create courseclasstasks');
    }

    /**
     * Determine whether the courseClassTask can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClassTask  $model
     * @return mixed
     */
    public function update(User $user, CourseClassTask $model)
    {
        return $user->hasPermissionTo('update courseclasstasks');
    }

    /**
     * Determine whether the courseClassTask can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClassTask  $model
     * @return mixed
     */
    public function delete(User $user, CourseClassTask $model)
    {
        return $user->hasPermissionTo('delete courseclasstasks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClassTask  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete courseclasstasks');
    }

    /**
     * Determine whether the courseClassTask can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClassTask  $model
     * @return mixed
     */
    public function restore(User $user, CourseClassTask $model)
    {
        return false;
    }

    /**
     * Determine whether the courseClassTask can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CourseClassTask  $model
     * @return mixed
     */
    public function forceDelete(User $user, CourseClassTask $model)
    {
        return false;
    }
}
