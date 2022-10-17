<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'JBI',
            'email' => 'jbi@jbi.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 1
        ]);
        User::create([
            'name' => 'LC',
            'email' => 'lc@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 2
        ]);
        User::create([
            'name' => 'JB',
            'email' => 'jb@jb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 3
        ]);
        User::create([
            'name' => 'AN Najah',
            'email' => 'an@an.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 3
        ]);
        User::create([
            'name' => 'LC Bogor',
            'email' => 'lcb@lcb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 3
        ]);
    }
}
