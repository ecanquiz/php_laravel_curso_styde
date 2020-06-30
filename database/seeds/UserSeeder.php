<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$professions = DB::select('SELECT id FROM professions WHERE title = ?', ['Desarrollador back-end']);
        //$professions = DB::table('professions')->select('id')->take(1)->get();

        //$profession = DB::table('professions')->select('id')->first();
        //$professions = DB::table('professions')->select('id')->where('title', '=', 'Desarrollador back-end')->first();

        //$profession = DB::table('professions')->select('id', 'title')->where('title', '=', 'Desarrollador back-end')->first();

        //$profession = DB::table('professions')->where('title', '=', 'Desarrollador back-end')->first();
        //$profession = DB::table('professions')->where('title', 'Desarrollador back-end')->first();

        //$profession = DB::table('professions')->where(['title' => 'Desarrollador back-end'])->first();

        //dd($profession);
        //dd($professions[0]);
        //dd($professions->first()); // $professions[0]

        //$profession = DB::table('professions')
        //   ->select('id')
        //    ->where('title', 'Desarrollador back-end')
        //    ->first();
        //dd($profession);

        //$professionId = DB::table('professions')
        //    ->where(['title' => 'Desarrollador back-end'])
        //    ->value('id');

        //$professionId = DB::table('professions')
        //    ->where('title' , 'Desarrollador back-end')
        //    ->value('id');

        //$professionId = DB::table('professions')
        //    ->whereTitle('Desarrollador back-end')
        //    ->value('id');

        //dd($professionId);

        /*DB::table('users')->insert([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'password' => bcrypt('123456'),
            'profession_id' => DB::table('professions')
                ->whereTitle('Desarrollador back-end')
                ->value('id')
            //'profession_id' => $professionId
            //'profession_id' => $profession->id
            //'profession_id' => $professions->first()->id
            //'profession_id' => $professions[0]->id
        ]);*/

        /*User::create([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'password' => bcrypt('123456'),
            'profession_id' => DB::table('professions')
                ->whereTitle('Desarrollador back-end')
                ->value('id')
        ]);*/

        

        User::create([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'password' => bcrypt('123456'),
            'profession_id' => Profession::whereTitle('Desarrollador back-end')->value('id')
        ]);

        User::create([
            'name' => 'Another user',
            'email' => 'another@user.com',
            'password' => bcrypt('123456'),
            'profession_id' => Profession::whereTitle('Desarrollador front-end')->value('id')
        ]);

        /*factory(User::class)->([
            'name' => 'Another user',
            'email' => 'another@gmail.com',
            'password' => bcrypt('123456'),
            'profession_id' => Profession::whereTitle('Desarrollador front-end')->value('id')
        ]);

        factory(User::class)->([
            'email' => 'another@gmail.com',
            'password' => bcrypt('123456'),
            'profession_id' => Profession::whereTitle('Desarrollador front-end')->value('id')
        ]);

        factory(User::class)->create([
            'profession_id' => $profession
        ]);

        factory(User::class)->create([
            'profession_id' => Profession::whereTitle('Desarrollador front-end')->value('id')
        ]);

        factory(User::class)->create();

        factory(User::class, 48)->create();*/

        $professionId = Profession::where('title', 'Desarrollador back-end')->value('id');


        factory(User::class)->create([
            'profession_id' => $professionId
        ]);

        factory(User::class, 48)->create();


    }
}


