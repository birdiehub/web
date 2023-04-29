<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create-permissions']);
        Permission::create(['name' => 'edit-permissions']);
        Permission::create(['name' => 'delete-permissions']);
        Permission::create(['name' => 'view-permissions']);

        Permission::create(['name' => 'create-roles']);
        Permission::create(['name' => 'edit-roles']);
        Permission::create(['name' => 'delete-roles']);
        Permission::create(['name' => 'view-roles']);

        Permission::create(['name' => 'view-user-access']);
        Permission::create(['name' => 'grant-user-permissions']);
        Permission::create(['name' => 'revoke-user-permissions']);
        Permission::create(['name' => 'grant-user-roles']);
        Permission::create(['name' => 'revoke-user-roles']);


        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'view-users']);

        Permission::create(['name' => 'edit-self']);
        Permission::create(['name' => 'delete-self']);
        Permission::create(['name' => 'view-self']);

        Permission::create(['name' => 'create-players']);
        Permission::create(['name' => 'edit-players']);
        Permission::create(['name' => 'delete-players']);
        Permission::create(['name' => 'view-players']);

        Permission::create(['name' => 'create-countries']);
        Permission::create(['name' => 'edit-countries']);
        Permission::create(['name' => 'delete-countries']);
        Permission::create(['name' => 'view-countries']);

        // create roles and assign existing permissions
        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo('view-players');
        $viewer->givePermissionTo('view-countries');
        $viewer->givePermissionTo('view-self');
        $viewer->givePermissionTo('edit-self');

        $editor = Role::create(['name' => 'editor']);
        $editor->syncPermissions($viewer->permissions);
        $editor->givePermissionTo('create-players');
        $editor->givePermissionTo('edit-players');
        $editor->givePermissionTo('delete-players');
        $editor->givePermissionTo('create-countries');
        $editor->givePermissionTo('edit-countries');
        $editor->givePermissionTo('delete-countries');

        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions($editor->permissions);
        $admin->givePermissionTo('view-users');
        $admin->givePermissionTo('create-users');
        $admin->givePermissionTo('edit-users');
        $admin->givePermissionTo('delete-users');
        $admin->givePermissionTo('view-roles');
        $admin->givePermissionTo('view-permissions');
        $admin->givePermissionTo('view-user-access');
        $admin->givePermissionTo('grant-user-permissions');
        $admin->givePermissionTo('revoke-user-permissions');
        $admin->givePermissionTo('grant-user-roles');
        $admin->givePermissionTo('revoke-user-roles');

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $superAdmin = Role::create(['name' => 'super-admin']);

        $user = User::factory()->create([
            'username' => 'admin',
            'password' => '$2y$10$WwhvMo2h4.U1KBkfIU.8x.XPXG8QcaSNposuL5VALLyWB7LHa2Qz2',
            'first_name' => 'Thibo',
            'last_name' => 'Verbeerst',
            'email' => 'contact@thiboverbeerst.com',
            'phone' => '+32 471 72 15 98',
            'address' => 'Haandeput 11',
            'city' => 'Meulebeke',
            'zip' => '8760',
            'country_id' => 1,
        ]);
        $user->assignRole($superAdmin);
    }
}
