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
            'name'=>'Sekretaris',
            'email'=>'secretary@gmail.com',
            'password'=>bcrypt('password'),
            'NIP'=>'123456',
            'role'=>'secretary',
        ]);
    }
}
