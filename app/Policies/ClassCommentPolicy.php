<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ClassComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the classComment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list classcomments');
    }

    /**
     * Determine whether the classComment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClassComment  $model
     * @return mixed
     */
    public function view(User $user, ClassComment $model)
    {
        return $user->hasPermissionTo('view classcomments');
    }

    /**
     * Determine whether the classComment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create classcomments');
    }

    /**
     * Determine whether the classComment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClassComment  $model
     * @return mixed
     */
    public function update(User $user, ClassComment $model)
    {
        return $user->hasPermissionTo('update classcomments');
    }

    /**
     * Determine whether the classComment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClassComment  $model
     * @return mixed
     */
    public function delete(User $user, ClassComment $model)
    {
        return $user->hasPermissionTo('delete classcomments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClassComment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete classcomments');
    }

    /**
     * Determine whether the classComment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClassComment  $model
     * @return mixed
     */
    public function restore(User $user, ClassComment $model)
    {
        return false;
    }

    /**
     * Determine whether the classComment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ClassComment  $model
     * @return mixed
     */
    public function forceDelete(User $user, ClassComment $model)
    {
        return false;
    }
}
