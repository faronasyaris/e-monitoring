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
            'name'=>'Kepala Dinas',
            'email'=>'kepaladinas@gmail.com',
            'password'=>bcrypt('password'),
            'NIP'=>'123456',
            'role'=>'Kepala Dinas',
        ]);
        User::create([
            'name'=>'Sekretaris',
            'email'=>'sekretaris@gmail.com',
            'password'=>bcrypt('password'),
            'NIP'=>'123456',
            'role'=>'Sekretaris',
        ]);

        User::create([
            'name'=>'kepala bidang 1',
            'email'=>'kepalabidang1@gmail.com',
            'password'=>bcrypt('password'),
            'NIP'=>'123456',
            'role'=>'Kepala Bidang',
            'field_id'=>1
        ]);

        User::create([
            'name'=>'kepala bidang 2',
            'email'=>'kepalabidang2@gmail.com',
            'password'=>bcrypt('password'),
            'NIP'=>'123456',
            'role'=>'Kepala Bidang',
            'field_id'=>2
        ]);

        User::create([
            'name'=>'kepala bidang 3',
            'email'=>'kepalabidang3@gmail.com',
            'password'=>bcrypt('password'),
            'NIP'=>'123456',
            'role'=>'Kepala Bidang',
            'field_id'=>3
        ]);
    }
}
