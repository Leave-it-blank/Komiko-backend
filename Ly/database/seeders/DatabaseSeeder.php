<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'reader']);
        // create permissions
        Permission::create(['name' => 'create comic']);
        Permission::create(['name' => 'delete comic']);
        Permission::create(['name' => 'edit comic']);
        //new permissions
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'view comic management']);
        Permission::create(['name' => 'view management']);
        Permission::create(['name' => 'view authentication']);
        Permission::create(['name' => 'view settings']);

        //managemet_imp
        Permission::create(['name' => 'handle management']);
        Permission::create(['name' => 'handle settings management']);
        Permission::create(['name' => 'handle authentication']);
        Permission::create(['name' => 'handle dashboard']);
        Permission::create(['name' => 'handle comic management']);
        // create roles and assign created permissions

        $role = Role::create(['name' => 'Super-Admin']);

        $role = Role::create(['name' => 'Admin'])
            ->givePermissionTo(['create comic', 'edit comic','delete comic','view dashboard','view comic management','view management']);

        $role = Role::create(['name' => 'management'])
            ->givePermissionTo(['create comic', 'edit comic','delete comic',
                'view dashboard','view comic management' , 'view management' ,'view authentication',  'view settings',
                'handle management',  'handle settings management' , 'handle authentication' ,'handle dashboard', 'handle comic management' ]);



        // this can be done as separate statements
        $role = Role::create(['name' => 'ContentManager'])
            ->givePermissionTo([ 'create comic', 'edit comic','delete comic','view dashboard','view comic management']);
        $role = Role::create(['name' => 'Reader'])
            ->givePermissionTo(['reader']);

        $this->call(UserSeeder::class);
    }
}
