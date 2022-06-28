<?php
namespace App\Settings;


use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public $site_name, $discord_invite, $analytics, $tag_manager;

    public $carousel, $dark_mode, $side_bar, $search;
    public  $site_url, $debug_mode, $session_encryption, $cache_drive, $patreon, $disqus_shortname, $discord_server_id;

    public static function group(): string
    {
        return 'general';
    }
}
