<?php

namespace App\Settings;


use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name, $discord_invite, $adsense, $tag_manager, $keywords, $favicon, $site_logo_url;
    public bool $carousel, $dark_mode, $side_bar, $search, $debug_mode, $session_encryption;
    public string  $site_url,  $cache_drive, $patreon, $disqus_shortname, $discord_server_id, $paypal;

    public static function group(): string
    {
        return 'general';
    }
}
