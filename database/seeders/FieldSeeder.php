<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create([
            'name'=> 'Bidang Pemanfaatan dan Pengendalian Sumberdaya Perikanan',
        ]);

        Field::create([
            'name'=> 'Bidang Produksi, Prasarana dan Sarana Peternakan',
        ]);

        Field::create([
            'name'=> 'Bidang Kesehatan Hewan, Ikan, Kesmavet dan P2HP',
        ]);
    }
}
