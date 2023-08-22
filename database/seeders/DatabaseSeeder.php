<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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

        \App\Models\User::create([
            'name' => 'Admin Yayasan',
            'username' => 'adminyayasan',
            'email' => 'adminyayasan@gmail.com',
            'password' => bcrypt('yayasan123'),
            'level' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Admin Sekolah',
            'username' => 'adminsekolah',
            'email' => 'adminsekolah@gmail.com',
            'password' => bcrypt('sekolah123'),
            'level' => 'petugas',
        ]);

        \App\Models\User::create([
            'name' => 'Siswa',
            'username' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => bcrypt('siswa123'),
            'level' => 'siswa',
        ]);
    }
}
