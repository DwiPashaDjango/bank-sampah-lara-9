<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FacadesDB::table('users')->insert([
            [
                'name' => 'Rahmat Hidayatullah',
                'email' => 'rahmat@example.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Sakuranomiya',
                'email' => 'sakuranomiya@example.com',
                'role' => 'admin',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Chika Fujiwara',
                'email' => 'chika@example.com',
                'role' => 'guest',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'defan ilham ardiansyah',
                'email' => 'defanilham07@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('qwertyui'),
            ],
            [
                'name' => 'yudha',
                'email' => 'yudhabank77@gmail.com',
                'role' => 'guest',
                'password' => bcrypt('12345678'),
            ],
        ]);
    }
}
