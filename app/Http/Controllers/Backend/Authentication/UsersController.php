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
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    use AuthorizesRequests;
    public function getUsers()
    {   $this->authorize('view authentication',  Auth::user());
       // $this->authorize('view authentication',  User::class);
        //$this->authorize('handle authentication',  User::class);
        //return 'hi';
        return Inertia::render('Backend/Authentication/UsersList', [
            'users' => User::orderBy('name', 'asc')->get()->map(function ($user) {
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
        $this->authorize('handle authentication',    Auth::user());
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
        $this->authorize('handle authentication',  Auth::user());
       $userdata =  $this->validate($request, [ 'name' => 'required|string|max:40', 'email' => 'required|max:50|email' ]);

       try {
        $user->update([
            'name' => $userdata['name'],
            'email'=> $userdata['email']
           ]);
           $user->save();
            return Redirect::route('authentication.users') ->with('message', 'Updated Successfully.');

       } catch (\Throwable $th) {

            return Redirect::route('authentication.users') ->with('error', $th);

       }



    }
    public function storeCodes(User $user, Request $request)
    {
        $this->authorize('handle authentication',    Auth::user());
        //dd($request);
        $userdata =  $this->validate($request, [ 'password' =>'required|min:8|max:15' ]);
        //dd($userdata);
        try {
            $user->update([
                'password' => Hash::make($userdata['password'])
              ]);
              //$this->UpdateUserPassword::adminUpdate($user, $userdata);
              $user->save();
              return Redirect::route('authentication.users')->with('message', 'Updated Successfully.');
        } catch (\Throwable $th) {
            return Redirect::route('authentication.users')->with('error', 'Something went Wrong~');
        }

    }


    public function userRolesUpdate(Request $request ,  User $user){
        $this->authorize('handle authentication',    Auth::user());
        try{
           // dd($request->userRoles);
        $user->roles()->sync($request->userRoles);
        if ($user->save()) {
            return  redirect(routeAlias('authentication.users'))->with('message', 'Updated Successfully.');
        }
        }
        catch(\Exception $e){

            throw $e;
        }
        return redirect()->back()->with('message', 'Updated Successfully.');
    }
}
