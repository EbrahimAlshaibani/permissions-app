<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //roles
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            //permission
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            //users
            'user-list',
            'user-cerate',
            'user-edit',
            'user-delete',
        ];
        $permissions_description = [
            //roles
            'عرض الادوار',
            'اضافة دور',
            'تعديل دور',
            'حذف دور',
            //permission
            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            //users
            'عرض المستخدمين',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
        ];
        foreach ($permissions as $index =>  $permission) {
            Permission::create([
                'name' => $permission,
                'description'=>$permissions_description[$index]
            ]);
        }

        $user = User::create([
            'username' => 'admin',
            'name' => 'Super Admin', 
            'email' => 'admin@gmail.com',
            'is_enabled'=> true,
            'password' => '$2y$10$5oHi1/SqqlozX8zlFW4AsO6gTwZUEowMoCkC3XquR2SBa3zhAUInu', //password
            'hasChangedPassword'=> 0,
        ]);
        $role = Role::create(['name' => 'Admin']);
        
        $permissions = Permission::pluck('id','id')->all();
    
        $role->syncPermissions($permissions);
    
        $user->assignRole([$role->id]);
    }
}
