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
        $this->migrator->add('general.disqus_shortname', 'database');
        $this->migrator->add('general.discord_server_id', 'discord.com');
        $this->migrator->add('general.discord_invite', 'discord.gg');
        $this->migrator->add('general.analytics','google.com');
        $this->migrator->add('general.tag_manager', 'googletag.com');
        $this->migrator->add('general.search', false);
        $this->migrator->add('general.dark_mode', false);
        $this->migrator->add('general.side_bar', false);
        $this->migrator->add('general.carousel', false);
    }
}
