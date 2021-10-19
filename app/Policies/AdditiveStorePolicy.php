<?php

namespace App\Policies;

use App\Models\AdditiveStore;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdditiveStorePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return in_array($user -> role_id, [1,2,3,4, 5] )
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    public function create(User $user)
    {
        return in_array($user -> role_id, [1,2] )
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdditiveStore  $additiveStore
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return in_array($user -> role_id, [1,2] )
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdditiveStore  $additiveStore
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return in_array($user -> role_id, [1,2] )
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }
}
