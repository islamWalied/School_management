<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'user_type' => 'student',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'user_type' => 'admin',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'user_type' => 'teacher',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'parents',
            'email' => 'parents@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'user_type' => 'parents',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'islam',
            'email' => 'islam.walied96@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'user_type' => 'admin',
            'remember_token' => Str::random(10),
        ]);
    }
}
