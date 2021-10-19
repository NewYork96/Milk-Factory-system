<?php

namespace App\Policies;

use App\Models\ProductionOrder;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProductionOrderPolicy
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
        return in_array($user -> role_id, [1,2,3,4] )
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
        return in_array($user -> role_id, [1,3] )
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return in_array($user -> role_id, [1,3] )
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return in_array($user -> role_id, [1,3] )
        ? Response::allow()
        : Response::deny('Hozzáférés megtagadva!');
    }
}
