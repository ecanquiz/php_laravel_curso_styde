<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        //DB::table('professions')->truncate();
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        DB::table('professions')->insert([
            'title' => 'Desarrollador back-end'
        ]);

        DB::table('professions')->insert([
            'title' => 'Desarrollador front-end'
        ]);

        DB::table('professions')->insert([
            'title' => 'Diseñador web'
        ]);

    }
}
