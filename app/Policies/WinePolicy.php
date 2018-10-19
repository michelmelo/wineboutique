<?php

namespace App\Policies;

use App\User;
use App\Wine;
use Illuminate\Auth\Access\HandlesAuthorization;

class WinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list wines.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function list(User $user)
    {
        return $user->isSeller();
    }

    /**
     * Determine whether the user can view the wine.
     *
     * @param  \App\User  $user
     * @param  \App\Wine  $wine
     * @return mixed
     */
    public function view(User $user, Wine $wine)
    {
        return true;
    }

    /**
     * Determine whether the user can create wines.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSeller();
    }

    /**
     * Determine whether the user can update the wine.
     *
     * @param  \App\User  $user
     * @param  \App\Wine  $wine
     * @return mixed
     */
    public function update(User $user, Wine $wine)
    {
        return $user->isSeller() && $wine->winery->id===$user->winery->id;
    }

    /**
     * Determine whether the user can delete the wine.
     *
     * @param  \App\User  $user
     * @param  \App\Wine  $wine
     * @return mixed
     */
    public function delete(User $user, Wine $wine)
    {
        return $user->isSeller() && $wine->winery->id===$user->winery->id;
    }

    /**
     * Determine whether the user can restore the wine.
     *
     * @param  \App\User  $user
     * @param  \App\Wine  $wine
     * @return mixed
     */
    public function restore(User $user, Wine $wine)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the wine.
     *
     * @param  \App\User  $user
     * @param  \App\Wine  $wine
     * @return mixed
     */
    public function forceDelete(User $user, Wine $wine)
    {
        //
    }
}
