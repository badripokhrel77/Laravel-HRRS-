<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = new User();
        $admin->f_name = "Admin";
        $admin->l_name = "Admin";
        $admin->phone = "777";
        $admin->address = "Admin";
        $admin->email = "admin@gmail.com";
        $admin->password = Hash::make("admin21");
        $admin->role = "admin";
        $admin->save();
    }
}
