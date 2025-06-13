<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'username' => 'Kelompok8',
            'password' => Hash::make('WADBest123'),
            'nama' => 'Admin Telmed',
            'email' => 'kelompok8@gmail.com'
        ]);
    }
} 