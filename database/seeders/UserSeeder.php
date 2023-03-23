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
            'name' => 'Qomar',
            'email' => 'jbi@jbi.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 1
        ]);
        User::create([
            'name' => 'Ismail',
            'email' => 'jbi1@jbi.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 1
        ]);
        User::create([
            'name' => 'Sunan',
            'email' => 'jbi2@jbi.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 1
        ]);
        User::create([
            'name' => 'Boy',
            'email' => 'lc@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 2
        ]);
        User::create([
            'name' => 'Rizal',
            'email' => 'lc1@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 2
        ]);
        User::create([
            'name' => 'Roby',
            'email' => 'lc2@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 2
        ]);
        User::create([
            'name' => 'Ari',
            'email' => 'jb@jb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 3
        ]);
        User::create([
            'name' => 'Resti',
            'email' => 'jb1@jb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 3
        ]);
        User::create([
            'name' => 'Maria',
            'email' => 'jb2@jb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 3
        ]);
        User::create([
            'name' => 'Aga',
            'email' => 'an@an.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 4
        ]);
        User::create([
            'name' => 'Rina',
            'email' => 'an1@an.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 4
        ]);
        User::create([
            'name' => 'Agam',
            'email' => 'an2@an.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 4
        ]);
        User::create([
            'name' => 'Cusin',
            'email' => 'lcb@lcb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 5
        ]);
        User::create([
            'name' => 'Ria',
            'email' => 'lcb1@lcb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 5
        ]);
        User::create([
            'name' => 'Panjul',
            'email' => 'lcb2@lcb.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 5
        ]);
        User::create([
            'name' => 'Jogja1',
            'email' => 'jogja1@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 6
        ]);
        User::create([
            'name' => 'Jogja2',
            'email' => 'jogja2@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 6
        ]);
        User::create([
            'name' => 'Jogja2',
            'email' => 'jogja3@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 6
        ]);
        User::create([
            'name' => 'Bandung1',
            'email' => 'Bandung1@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 7
        ]);
        User::create([
            'name' => 'Bandung2',
            'email' => 'Bandung2@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 7
        ]);
        User::create([
            'name' => 'Bandung3',
            'email' => 'Bandung3@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 7
        ]);
        User::create([
            'name' => 'Bekasi1',
            'email' => 'Bekasi1@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 1,
            'company_id' => 8
        ]);
        User::create([
            'name' => 'Bekasi2',
            'email' => 'Bekasi2@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 2,
            'company_id' => 8
        ]);
        User::create([
            'name' => 'Bekasi3',
            'email' => 'Bekasi3@lc.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => \Str::random(10),
            'devision_id' => 3,
            'company_id' => 7
        ]);
    }
}
