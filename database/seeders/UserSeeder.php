<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::FirstOrCreate([
            'name' => 'admin' ,
            'guard_name' => 'web'
            ])->givePermissionTo(Permission::all());

        User::FirstOrCreate([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ])->assignrole('admin');

        Role::FirstOrCreate([
            'name' => 'author' ,
            'guard_name' => 'web'
            ])->givePermissionTo(
                'add-posts',
                'show-posts',
                'update-posts',
                'delete-posts',
                'access-posts'
            );

        User::FirstOrCreate([
            'name' => 'Author',
            'email' => 'author@example.com',
            'password' => Hash::make('password'),
        ])->assignrole('author');
    }
}
