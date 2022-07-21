<?php

namespace App\Http\Controllers\Backend\Management;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
class AdvertismentController extends Controller
{
    use AuthorizesRequests;
     public function viewAdvertisement()
     {
        $this->authorize('view management',    Auth::user());
       // dd( Advertisement::all()->toArray());
        return Inertia::render('Backend/Management/Advertisements/ViewAdvertisement', [
            'advertisements' => Advertisement::orderBy('name', 'asc')->get()->toArray(),
        ]);
     }
     public function statusUpdateAdvertisement(Advertisement $advertisement)
     {
        $this->authorize('view management',    Auth::user());
        try{
            $advertisement->is_enabled == true? $advertisement->update(['is_enabled' => false]) : $advertisement->update(['is_enabled' => true]);
            return redirect()->back()->with('message', 'Updated Successfully.');
        }catch(Exception $e){
              return redirect()->back()->with('error', 'Update unsuccessful.');
        }

     }

     public function editAdvertisement(Advertisement $advertisement)
     {
        $this->authorize('handle management',    Auth::user());
        return Inertia::render('Backend/Management/Advertisements/EditAdvertisement', [
            'advertisement' => $advertisement->toArray(),
        ]);
     }

     public function editStoreAdvertisement(Advertisement $advertisement, Request $request)
     {
        $this->authorize('handle management',    Auth::user());
        $data =  $this->validate($request, [
            'is_enabled' => 'required|bool',
            //  'upload_date' => 'string',
            'code' => 'required|string',
            'expires_at' => 'required',
        ]);
        try{
            $advertisement->update([
                'code' => $data["code"],
                'expires_at' => $data["expires_at"],
                'is_enabled' => $data["is_enabled"],
        ]);

        return redirect()->back()->with('message', 'Updated Successfully.');
        }catch(Exception $e){
            throw $e;
            return redirect()->back()->with('error', 'Update Unsuccessful.');
        }

     }
}
