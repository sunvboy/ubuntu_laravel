<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.carts.index'));
    }
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.carts.create'));
    }
    public function edit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.carts.edit'));
    }

    public function destroy(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.carts.destroy'));
    }
}
