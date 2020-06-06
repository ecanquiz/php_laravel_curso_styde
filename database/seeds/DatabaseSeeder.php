<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'professions'
        ]);

        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        //DB::table('professions')->truncate();
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        //$this->call(UsersTableSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(ProfessionSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach($tables as $table)
            DB::table($table)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
    }
}
