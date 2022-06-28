<?php

namespace App\Http\Controllers\Backend\Authentication;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class UsersController extends Controller
{
    public function getUsers()
    {
        //return 'hi';
        return Inertia::render('Backend/Authentication/UsersList', [
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'edit_url' => URL::route('authentication.users.edit', $user),
                ];
            }),

        ]);
    }
    public function editUser(User $user)
    {
        # code...
    }
}
