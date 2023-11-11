<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.pages.index'));
    }
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.pages.create'));
    }
    public function edit(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.pages.edit'));
    }

    public function destroy(User $user)
    {
        return $user->checkPermissionAccess(config('permissions.pages.destroy'));
    }
}
