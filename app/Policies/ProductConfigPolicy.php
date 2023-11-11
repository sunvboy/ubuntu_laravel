<?php

namespace App\Policies;

use App\Models\ProductConfig;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductConfigPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.product_configs.index'));
    }
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.product_configs.create'));
    }
    public function edit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.product_configs.edit'));
    }

    public function destroy(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.product_configs.destroy'));
    }
}
