<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StudentTaskAttach;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentTaskAttachPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the studentTaskAttach can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list studenttaskattaches');
    }

    /**
     * Determine whether the studentTaskAttach can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTaskAttach  $model
     * @return mixed
     */
    public function view(User $user, StudentTaskAttach $model)
    {
        return $user->hasPermissionTo('view studenttaskattaches');
    }

    /**
     * Determine whether the studentTaskAttach can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create studenttaskattaches');
    }

    /**
     * Determine whether the studentTaskAttach can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTaskAttach  $model
     * @return mixed
     */
    public function update(User $user, StudentTaskAttach $model)
    {
        return $user->hasPermissionTo('update studenttaskattaches');
    }

    /**
     * Determine whether the studentTaskAttach can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTaskAttach  $model
     * @return mixed
     */
    public function delete(User $user, StudentTaskAttach $model)
    {
        return $user->hasPermissionTo('delete studenttaskattaches');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTaskAttach  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete studenttaskattaches');
    }

    /**
     * Determine whether the studentTaskAttach can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTaskAttach  $model
     * @return mixed
     */
    public function restore(User $user, StudentTaskAttach $model)
    {
        return false;
    }

    /**
     * Determine whether the studentTaskAttach can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\StudentTaskAttach  $model
     * @return mixed
     */
    public function forceDelete(User $user, StudentTaskAttach $model)
    {
        return false;
    }
}
