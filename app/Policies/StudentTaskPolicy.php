<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StudentTask;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentTaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the studentTask can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list studenttasks');
    }

    /**
     * Determine whether the studentTask can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTask  $model
     * @return mixed
     */
    public function view(User $user, StudentTask $model)
    {
        return $user->hasPermissionTo('view studenttasks');
    }

    /**
     * Determine whether the studentTask can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create studenttasks');
    }

    /**
     * Determine whether the studentTask can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTask  $model
     * @return mixed
     */
    public function update(User $user, StudentTask $model)
    {
        return $user->hasPermissionTo('update studenttasks');
    }

    /**
     * Determine whether the studentTask can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTask  $model
     * @return mixed
     */
    public function delete(User $user, StudentTask $model)
    {
        return $user->hasPermissionTo('delete studenttasks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTask  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete studenttasks');
    }

    /**
     * Determine whether the studentTask can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTask  $model
     * @return mixed
     */
    public function restore(User $user, StudentTask $model)
    {
        return false;
    }

    /**
     * Determine whether the studentTask can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTask  $model
     * @return mixed
     */
    public function forceDelete(User $user, StudentTask $model)
    {
        return false;
    }
}
