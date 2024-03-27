<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make("admin123"),
            'roles' => 'admin'
        ]);

        User::create([
            'name' => "Wadir 4",
            'email' => "wadir4@gmail.com",
            'password' => Hash::make("wadir1234"),
            'roles' => 'wadir4'
        ]);
        User::create([
            'name' => "Staf Ahli Wadir 4",
            'email' => "stafAhli@gmail.com",
            'password' => Hash::make("wadir1234"),
            'roles' => 'staf_ahli'
        ]);
        User::create([
            'name' => "Tendik",
            'email' => "tendik@gmail.com",
            'password' => Hash::make("tendik1234"),
            'roles' => 'tendik'
        ]);
        User::create([
            'name' => "Dosen",
            'email' => "dosen@gmail.com",
            'password' => Hash::make("dosen1234"),
            'roles' => 'dosen'
        ]);
    }
}
