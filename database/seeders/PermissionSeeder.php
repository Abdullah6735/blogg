<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::FirstOrCreate([ 'name' => 'access-all-users' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'add-posts' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'delete-posts' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'update-posts' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'show-posts' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'access-posts' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'access-categories' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'add-categories' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'delete-categories' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'update-categories' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'show-categories' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'access-permissions' , 'guard_name' => 'web']);
        Permission::FirstOrCreate([ 'name' => 'access-roles' , 'guard_name' => 'web']);
    }
}
