<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class UserWithAdminSeeder extends Seeder
{
    public function run()
    {

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@telship.com',
            'email_verified_at' => now(),
            'password' => Hash::make('telship999'),
            'remember_token' => null,
            'id_perusahaan' =>  null,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        Admin::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'password' => $user->password,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}