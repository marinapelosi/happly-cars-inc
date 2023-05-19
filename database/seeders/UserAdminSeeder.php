<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Happly Admin',
            'email' => 'admin@happly.ai',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'is_admin' => true,
            'remember_token' => Str::random(10),
        ]);
    }
}
