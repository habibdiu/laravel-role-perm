<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            "user.create",
            "user.view",
            "user.edit",
            "user.delete",
            "role.create",
            "role.view",
            "role.edit",
            "role.delete",
        ];

        foreach($permissions as $key=>$value){
            Permission::create(["name"=>$value]);
        }
    }
}
