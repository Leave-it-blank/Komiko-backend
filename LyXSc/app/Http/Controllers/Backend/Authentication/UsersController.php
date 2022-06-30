<?php

namespace App\Http\Controllers\Backend\Authentication;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use function route as routeAlias;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class UsersController extends Controller
{
    use AuthorizesRequests;
    public function getUsers()
    {

        //return 'hi';
        return Inertia::render('Backend/Authentication/UsersList', [
            'users' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profileUrl' => $user->profile_photo_path,
                    'editUrl' => 'authentication.users.edit',
                    'createdAt' => $user->created_at,
                    'updatedAt' => $user->updated_at,
                    'currentRoles' =>  $user->roles->pluck('name')
                ];
            })->toArray(),

        ]);
    }
    public function editUser(User $user)
    {
        //dd($user);
        $roles = Role::all();
        $currentRolesId = $user->roles->pluck('id');
        return Inertia::render('Backend/Authentication/UserActions/Edit', [
            'tuser' => $user ,
            'roles' => $roles,
            'crUID' => $currentRolesId,
        ]);
    }
    public function storeDetails(User $user, Request $request)
    {
       $userdata =  $this->validate($request, [ 'name' => 'required|string|max:5', 'email' => 'required|max:50|email' ]);

       $user->update([
        'name' => $userdata['name'],
        'email'=> $userdata['email']
       ]);
       $user->save();
        return Redirect::route('authentication.users');


    }
    public function storeCodes(User $user, Request $request)
    {
        //dd($request);
        $userdata =  $this->validate($request, [ 'password' =>'required|min:8|max:15' ]);
        //dd($userdata);
        $user->update([
          'password' => Hash::make($userdata['password'])
        ]);
        //$this->UpdateUserPassword::adminUpdate($user, $userdata);
        $user->save();
        return Redirect::route('authentication.users');
    }


    public function userRolesUpdate(Request $request ,  User $user){
       $this->authorize('auth_management_update',  User::class);
        try{
           // dd($request->userRoles);
        $user->roles()->sync($request->userRoles);
        if ($user->save()) {
            return  redirect(routeAlias('authentication.users'));
        }
        }
        catch(\Exception $e){

            session()->flash('warning', 'something went wrong! try again');
            //dd($e);
        }
        return redirect()->back();
    }
}
