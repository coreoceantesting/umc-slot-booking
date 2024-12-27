<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id' => 1,
                'name' => 'dashboard.view',
                'group' => 'dashboard',
            ],
            [
                'id' => 2,
                'name' => 'users.view',
                'group' => 'users',
            ],
            [
                'id' => 3,
                'name' => 'users.create',
                'group' => 'users',
            ],
            [
                'id' => 4,
                'name' => 'users.edit',
                'group' => 'users',
            ],
            [
                'id' => 5,
                'name' => 'users.delete',
                'group' => 'users',
            ],
            [
                'id' => 6,
                'name' => 'users.toggle_status',
                'group' => 'users',
            ],
            [
                'id' => 7,
                'name' => 'users.change_password',
                'group' => 'users',
            ],
            [
                'id' => 8,
                'name' => 'roles.view',
                'group' => 'roles',
            ],
            [
                'id' => 9,
                'name' => 'roles.create',
                'group' => 'roles',
            ],
            [
                'id' => 10,
                'name' => 'roles.edit',
                'group' => 'roles',
            ],
            [
                'id' => 11,
                'name' => 'roles.delete',
                'group' => 'roles',
            ],
            [
                'id' => 12,
                'name' => 'roles.assign',
                'group' => 'roles',
            ],
            [
                'id' => 13,
                'name' => 'wards.view',
                'group' => 'wards',
            ],
            [
                'id' => 14,
                'name' => 'wards.create',
                'group' => 'wards',
            ],
            [
                'id' => 15,
                'name' => 'wards.edit',
                'group' => 'wards',
            ],
            [
                'id' => 16,
                'name' => 'wards.delete',
                'group' => 'wards',
            ],
            [
                'id' => 17,
                'name' => 'propertytype.view',
                'group' => 'propertytype',
            ],
            [
                'id' => 18,
                'name' => 'propertytype.create',
                'group' => 'propertytype',
            ],
            [
                'id' => 20,
                'name' => 'propertytype.edit',
                'group' => 'propertytype',
            ],
            [
                'id' => 21,
                'name' => 'propertytype.delete',
                'group' => 'propertytype',
            ],
            [
                'id' => 22,
                'name' => 'property.view',
                'group' => 'property',
            ],
            [
                'id' => 23,
                'name' => 'property.create',
                'group' => 'property',
            ],
            [
                'id' => 24,
                'name' => 'property.edit',
                'group' => 'property',
            ],
            [
                'id' => 25,
                'name' => 'property.delete',
                'group' => 'property',
            ],
            [
                'id' => 26,
                'name' => 'department.view',
                'group' => 'department',
            ],
            [
                'id' => 27,
                'name' => 'department.create',
                'group' => 'department',
            ],
            [
                'id' => 28,
                'name' => 'department.edit',
                'group' => 'department',
            ],
            [
                'id' => 29,
                'name' => 'department.delete',
                'group' => 'department',
            ],
            [
                'id' => 30,
                'name' => 'slot.view',
                'group' => 'slot',
            ],
            [
                'id' => 31,
                'name' => 'slot.create',
                'group' => 'slot',
            ],
            [
                'id' => 32,
                'name' => 'slot.edit',
                'group' => 'slot',
            ],
            [
                'id' => 33,
                'name' => 'slot.delete',
                'group' => 'slot',
            ],
            [
                'id' => 34,
                'name' => 'propertydetails.view',
                'group' => 'propertydetails',
            ],
            [
                'id' => 35,
                'name' => 'propertydetails.create',
                'group' => 'propertydetails',
            ],
            [
                'id' => 36,
                'name' => 'propertydetails.edit',
                'group' => 'propertydetails',
            ],
            [
                'id' => 37,
                'name' => 'propertydetails.delete',
                'group' => 'propertydetails',
            ],
            [
                'id' => 38,
                'name' => 'slotbooking.view',
                'group' => 'slotbooking',
            ],
            [
                'id' => 39,
                'name' => 'slotbooking.create',
                'group' => 'slotbooking',
            ],
            [
                'id' => 40,
                'name' => 'slotbooking.edit',
                'group' => 'slotbooking',
            ],
            [
                'id' => 41,
                'name' => 'slotbooking.delete',
                'group' => 'slotbooking',
            ],
            [
                'id' => 42,
                'name' => 'pendinglist.pending_list',
                'group' => 'pendinglist',
            ],
            [
                'id' => 43,
                'name' => 'returnlist.return_list',
                'group' => 'returnlist',
            ],
            [
                'id' => 44,
                'name' => 'approvelist.approve_list',
                'group' => 'approvelist',
            ],

        ];

        foreach ($permissions as $permission)
        {
            Permission::updateOrCreate([
                'id' => $permission['id']
            ], [
                'id' => $permission['id'],
                'name' => $permission['name'],
                'group' => $permission['group']
            ]);
        }
    }
}
