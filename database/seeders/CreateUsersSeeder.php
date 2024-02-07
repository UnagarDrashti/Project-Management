<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Admin',
               'email'=>'admin@hrm.com',
               'role'=>'owner',
               'password'=> bcrypt('admin@123'),
            ],
            [
               'name'=>'Team Leader',
               'email'=>'teamleader@hrm.com',
               'role'=> 'team-leader',
               'password'=> bcrypt('team@123'),
            ],
            [
               'name'=>'Employee',
               'email'=>'employee@hrm.com',
               'role'=>'employee',
               'password'=> bcrypt('12345678'),
            ],
        ];
    
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
