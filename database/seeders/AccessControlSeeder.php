<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AccessControlSeeder extends Seeder
{

    private array $_permissions;
    private array $_roles;

    public function __construct()
    {
        $this->_permissions = json_decode(Storage::get('data/access-control/permissions.json'), true)['permissions'];
        $this->_roles = json_decode(Storage::get('data/access-control/roles.json'), true)['roles'];
    }

    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach ($this->_permissions as $permission) {
            try {
                Permission::create($permission);
            } catch (\Exception $e) {
                continue;
            }
        }

        foreach ($this->_roles as $role) {
            $model = Role::create(["name" => $role["name"]]);
            $model->syncPermissions($this->permissions($role));

            User::factory()->create([
                'username' => 'test-' . $role["name"],
                'password' => '$2y$10$WwhvMo2h4.U1KBkfIU.8x.XPXG8QcaSNposuL5VALLyWB7LHa2Qz2' // BluePeach
            ])->assignRole($model);
        }
    }

    private function permissions($role)
    {
        return $this->merge($this->getInherentPermissions($role), $this->getGroupPermissions($role), $this->getDirectPermissions($role));
    }

    private function getDirectPermissions($role) : array
    {
        $result = [];
        foreach ($role["permissions"]["direct"] as $permission) {
            $result[] = $permission;
        }
        return $result;
    }

    private function getGroupPermissions($role) : array
    {
        $result = [];
        foreach ($role["permissions"]["groups"] as $groupName) {
            foreach ($this->_permissions as $permission) {
                if ($permission["group"] === $groupName) {
                    $result[] = $permission["name"];
                }
            }
        }
        return $result;
    }

    private function getInherentPermissions($role) : array
    {
        $result = [];
        foreach ($role["inherits"] as $otherName) {
            if($otherName === $role["name"] ) continue;
            $result = $this->merge($result, $this->permissions($this->findRole($otherName)));
        }
        return $result;
    }

    private function findRole($name)
    {
        foreach ($this->_roles as $role) {
            if ($role["name"] === $name) return $role;
        }
        return null;
    }

    private function merge(...$arrays) : array
    {
        return array_values(array_unique(array_merge(...$arrays)));
    }
}
