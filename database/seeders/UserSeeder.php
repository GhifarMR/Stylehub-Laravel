<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@gmail.com'],
            [
                'nama_user' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'level' => 'admin',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        DB::table('users')->updateOrInsert(
            ['email' => 'kasir@gmail.com'],
            [
                'nama_user' => 'kasir',
                'username' => 'kasir',
                'password' => Hash::make('password'),
                'level' => 'kasir',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
