<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BrandPolicy
{
    use HandlesAuthorization;
    public function index(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.brands.index'));
    }
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.brands.create'));
    }
    public function edit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.brands.edit'));
    }

    public function destroy(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.brands.destroy'));
    }
}
