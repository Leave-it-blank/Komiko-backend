<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Spatie');
        $this->migrator->add('general.site_url', 'scans.com');
        $this->migrator->add('general.debug_mode', false);
        $this->migrator->add('general.session_encryption', false);
        $this->migrator->add('general.cache_drive', 'database');
        $this->migrator->add('general.patreon', 'patreon.com');
        $this->migrator->add('general.disqus_shortname', 'testsite-q2cy98osnk');
        $this->migrator->add('general.discord_server_id', 'discord.com');
        $this->migrator->add('general.discord_invite', 'discord.gg');
        $this->migrator->add('general.adsense', 'google.com');
        $this->migrator->add('general.tag_manager', 'UA-11572402280-1');
        $this->migrator->add('general.favicon', 'url');
        $this->migrator->add('general.keywords', 'comics, manga, manhua, manwha, novel, adaptaion, scanlation, action_manga, manhua');
        $this->migrator->add('general.search', false);
        $this->migrator->add('general.dark_mode', false);
        $this->migrator->add('general.side_bar', false);
        $this->migrator->add('general.carousel', false);
    }
}
