<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_categories')->insert([
            [
                'name' => 'プログラミング',
                'user_id' => 1
            ],
            [
                'name' => '読書',
                'user_id' => 1
            ]
        ]);
    }
}
