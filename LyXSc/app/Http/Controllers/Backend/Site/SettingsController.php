<?php

namespace App\Http\Controllers\Backend\Site;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
class SettingsController extends Controller
{  use AuthorizesRequests;
    public function viewSettings()
    {
        $this->authorize('view settings',    Auth::user());
        //return 'hi';
        return Inertia::render('Backend/SiteManagement/ListSettings', [
            'settings' => app(GeneralSettings::class)->toArray(),
        ]);
    }

    public function updateSettings(Request $request)
    {
        $this->authorize('handle settings management', Auth::user());
        $data =  $this->validate($request, [
            'site_name' => 'required|string',
            'site_url' => 'string',
            'debug_mode' => 'bool|required',
            'session_encryption' => 'bool|required',
            'cache_drive' => 'required|string',
            'patreon' => 'String',
            'disqus_shortname' => 'String',
            'discord_server_id' => 'string',
            'discord_invite' => 'string',
            'analytics' => 'string',
            'tag_manager' => 'string',
            'search' => 'bool|required',
            'dark_mode' => 'bool|required',
            'side_bar' => 'bool|required',
            'carousel' => 'bool|required',
        ]);
     //   dd($data);
        try {
            $settings = app(GeneralSettings::class);

            //return dd($data.site_name);
             $settings->__set('site_name', $data["site_name"]);
             $settings->__set('site_url', $data["site_url"]);
             $settings->__set('debug_mode', $data["debug_mode"]);
             $settings->__set('session_encryption', $data["session_encryption"]);
             $settings->__set('cache_drive', $data["cache_drive"]);
             $settings->__set('patreon', $data["patreon"]);
             $settings->__set('disqus_shortname', $data["disqus_shortname"]);
             $settings->__set('discord_server_id', $data["discord_server_id"]);
             $settings->__set('discord_invite', $data["discord_invite"]);
             $settings->__set('analytics', $data["analytics"]);
             $settings->__set('tag_manager', $data["tag_manager"]);
             $settings->__set('side_bar', $data["side_bar"]);
             $settings->__set('search', $data["search"]);
             $settings->__set('dark_mode', $data["dark_mode"]);
             $settings->__set('carousel', $data["carousel"]);
             $settings->save();
             $settings->refresh();
             Cache::flush();
            return redirect()->back()->with('message', 'Updated Successfully.');
         }
         catch(\Exception $e){
             throw $e;
         }
    }
}
