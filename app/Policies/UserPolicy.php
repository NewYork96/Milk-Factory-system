<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    public function updateRole(User $user)
    {
        return $user -> role_id === 1
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        return $user -> id === $model -> id || $user -> role_id === 1
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user -> role_id === 1
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return $user -> id === $model -> id || $user -> role_id === 1
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $auth
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user -> role_id === 1
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }


}
