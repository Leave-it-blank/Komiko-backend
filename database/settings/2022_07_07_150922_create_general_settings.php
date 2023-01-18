<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'kiroku');
        $this->migrator->add('general.site_url', 'kiroku.com');
        $this->migrator->add('general.site_logo_url', 'https://ui-avatars.com/api/?name=s&color=7F9CF5&background=EBF4FF');//add to panel
        $this->migrator->add('general.debug_mode', false);
        $this->migrator->add('general.session_encryption', false);
        $this->migrator->add('general.cache_drive', 'database');
        $this->migrator->add('general.patreon', 'patreon.com');
        $this->migrator->add('general.disqus_shortname', 'testsite-q2cy98osnk');
        $this->migrator->add('general.reddit_url', 'testsite-q2cy98osnk'); //add to panel
        $this->migrator->add('general.discord_server_id', 'discord.com');
        $this->migrator->add('general.paypal', 'paypal.me.com');
        $this->migrator->add('general.discord_invite', 'discord.gg');
        $this->migrator->add('general.adsense', 'google.com');
        $this->migrator->add('general.tag_manager', 'GTM-MGFQVML');
        $this->migrator->add('general.favicon', 'url');//add to panel
        $this->migrator->add('general.keywords', 'comics, manga, manhua, manwha, novel, adaptaion, scanlation, action_manga, manhua'); //add to panel
        $this->migrator->add('general.search', false);
        $this->migrator->add('general.dark_mode', false);
        $this->migrator->add('general.layout', 'basic');//add to panel
        $this->migrator->add('general.side_bar', false);
        $this->migrator->add('general.carousel', false);
        $this->migrator->add('general.carousel_type', 'basic');//add to panel
    }
}
