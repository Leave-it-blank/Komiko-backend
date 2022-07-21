<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function management_create(User $user)
    {
        if ($user->can('handle management')) {

            return true;
        } else {
            return false;
        }
    }

    public function  management_delete(User $user): bool
    {
        if ($user->can('handle management')) {

            return true;
        }else {
            return false;
        }
    }
    public function  management_view(User $user): bool
    {
        if ($user->can('handle management')) {

            return true;
        } if ($user->can('view management')) {
        return true;
    }
    else {
        return false;
    }
    }
    public function  management_update(User $user): bool
    {
        if ($user->can('handle management')) {

            return true;
        } if ($user->can('view management')) {
        return true;
    }
    else {
        return false;
    }
    }
    // Handle Comic Management
    public function comic_management_create(User $user)
    {
        if ($user->can('handle comic management')) {

            return true;
        }
        if ($user->can('create comic')) {
            return true;
        } else {
            return false;
        }
    }
    public function comic_management_update(User $user)
    {
        if ($user->can('handle comic management')) {

            return true;
        }
        if ($user->can('create comic')) {
            return true;
        } else {
            return false;
        }
    }

    public function comic_management_delete(User $user): bool
    {
        if ($user->can('handle comic management')) {

            return true;
        }
        if ($user->can('delete comic')) {
            return true;
        } else {
            return false;
        }
    }
    public function comic_management_view(User $user): bool
    {
        if ($user->can('handle comic management')) {

            return true;
        }
        if ($user->can('view comic management')) {
            return true;
        } else {
            return false;
        }
    }
    // Handle Auth Management
    public function auth_management_create(User $user)
    {
        if ($user->can('handle authentication')) {

            return true;
        } else {
            return false;
        }
    }

    public function  auth_management_delete(User $user): bool
    {
        if ($user->can('handle authentication')) {

            return true;
        }else {
            return false;
        }
    }
    public function  auth_management_update(User $user): bool
    {
        if ($user->can('handle authentication')) {

            return true;
        }else {
            return false;
        }
    }
    public function  auth_management_view(User $user): bool
    {
        if ($user->can('handle authentication')) {

            return true;
        }
        else {
            return false;
        }
    }

    // Handle Auth Management
    public function settings_management_create(User $user)
    {
        if ($user->can('handle settings management')) {

            return true;
        } else {
            return false;
        }
    }
    public function settings_management_update(User $user)
    {
        if ($user->can('handle settings management')) {

            return true;
        } else {
            return false;
        }
    }

    public function  settings_management_delete(User $user): bool
    {
        if ($user->can('handle settings management')) {

            return true;
        }else {
            return false;
        }
    }
    public function  settings_management_view(User $user): bool
    {
        if ($user->can('handle settings management')) {

            return true;
        } if ($user->can('view settings')) {
        return true;
    }
    else {
        return false;
    }
    }
    //   handle dashboard Management
    public function dashboard_management_create(User $user)
    {
        if ($user->can('handle dashboard')) {

            return true;
        } else {
            return false;
        }
    }
    public function dashboard_management_update(User $user)
    {
        if ($user->can('handle dashboard')) {

            return true;
        } else {
            return false;
        }
    }

    public function  dashboard_management_delete(User $user): bool
    {
        if ($user->can('handle dashboard')) {

            return true;
        }else {
            return false;
        }
    }
    public function  dashboard_management_view(User $user): bool
    {
        if ($user->can('handle dashboard')) {

            return true;
        } if ($user->can('view dashboard')) {
        return true;
    }
    else {
        return false;
    }
    }
}
