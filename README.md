# php_laravel_curso_styde
Php Laravel Curso Styde

Lesson N° 3 - Rutas

$ php composer.phar

-getting started

$ mv composer.phar /usr/local/bim/compose

(update project dependencies)

$ compose update 

(start the development server)

$ php artisan server 

(Note: Laravel can be installed globally)

$ composer global require "laravel/installer"

Then, we have to make sure that the environment variable PATH of the operating system has included the directory where the globally installed packages are hosted and so they can be run without any problem.

(Direct)

$ create-proyect laravel/laravel curso "X.X"

Lesson 4° - Pruebas

$ vendor/bin/phpunit

$ alias t=vendor/bin/phpunit

$ php artisan make:test UsersModuleTest

$ php artisan make:test WelcomeUsersTest

Lesson °5 -Controladores

$ php artisan make:controller UserController

(The application logs can be viewed at: "storage/logs/laravel.log")

(In order for the Test to show errors, you can insert the following instruction in the respective method)

$this->withoutExceptionHandling();

$ php artisan make:controller WelcomeUserController

Lesson °7 - Blade

$ php artisan view:clear (Clear cache of compiled blade views)

Lesson °10 - Modify existing tables with Laravel migrations

$ php artisan migrate:reset

$ php artisan migrate:refresh

$ php artisan migrate:rollback

Lesson °11 - Create and associate tables using Laravel migrations (with foreign keys)

$ php artisan make:migration create_professions_table

Another option is:

$ php artisan make:migration new_professions_table --create=professions

$ php artisan make:migration add_profession_id_to_users

(From Laravel 5.5, to drop all tables and create all migrations from zero )

$ php artisan migrate:fresh 

(Warning: If you are in the production environment, Laravel warns and asks before if you really want to run that).

(Another thing: For those who have problems creating the foreign keys in the new versions of Laravel, use or change the function unsignedInteger () by unsignedBigInteger ()).

Lesson 12 - Inserting data with Laravel seeders

$ php artisan make:seeder ProfessionSeeder

$ php artisan db:seed

$ php artisan make:seeder UserSeeder

$ php artisan migrate:refresh --seed

$ php artisan migrate:fresh --seed

Lesson 13 - Introduction to Eloquent, the ORM of the Laravel framework

$ php artisan make:model Profession

$ php artisan db:seed

$ php artisan make:model Models/Profession

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{

    //protected $table = 'my_professions';

    //public $timestamps = false;

}

Lesson 14 - Introduction to Eloquent, the ORM of the Laravel framework

Lesson 15 - Using Eloquent ORM interactively with Tinker

$ php artisan tinker

If tinker is giving you error regarding a class call, you can try with:

$ composer dump-autoload

->>> use App\Models\Profession;

->>> $professions=Profession::all();

->>> $professions;

->>> $professions->first();

->>> $professions->last();

->>> $professions->random(2);

->>> $professions->pluck('title');

(Larave's collections are immutable)

->>> $professions;

->>> $titles = $professions->pluck('title');

->>> $titles;

->>> $professions;

->>> $randomProfessions = $professions->random(2);

->>> $randomProfessions;

->>> $professions;

->>> collect(['Ernesto', 'Canquiz', 'Laravel']);

->>> $backendDeveloper = Profession::where('title', 'Desarrollador back-end')->first();

->>> DB::table('professions')->where('title', 'Desarrollador back-end')->first();

->>> use App\Models\User;

->>> $user = User::first();

->>> $user = User::find(1);

Declaring non-static methods:

<?php

class User extends Authenticatable

{

    public function isAdmin()
    {
        return $this->email === 'myemail@domain.ext';
    }

->>> exit

$ php artisan tinker

->>> use App\Models\User;

->>> $user = User::first();

->>> $user = User::find(1);

->>> $user->isAdmin();

->>> $anotherUser = User::create(['name' => 'Another user', 'email' => 'another@user.com', 'password' => bcrypt(123456)]);

Declaring static methods:

<?php

class User extends Authenticatable

{

    public static function findByEmail($email)
    {
        return static::where(compact('email'))->first();
    }

->>> User::findByEmail('myemail@domain.ext');

Lesson 16 - Attribute handling in Eloquent ORM (solution to MassAssignmentException)

class MyClass extends Model {

    protected $fillable = [

        'field_name'

    ];

    protected $casts = [

       'field_name' => 'field_type'

    ];

$ php artisan tinker

->>> Use App\Models\Profession;

->>> $data = ['title' => 'Profesor', 'id' => 10 ];

->>> Profession::create($data);

->>> $user->save();

->>> $user->exists;

->>> $user->delete();

Lesson 17 - Relationship management with the ORM Eloquent

$ php artisan tinker

use \App\Models\User;

->>> $user = User::first();

->>> $user->profession;

->>> use \App\Models\Profession;

->>> Profession::where('id', $user->profession_id)->first();

->>> Profession::find($user->profession_id);

use App\Models\Profession;

class User extends Authenticatable

{

    public function profession()

    {

       return $this->belongsTo(Profession::class);

    }

->>> $user->profession;

use App\Models\User;

class Profession extends Model

{

    public function users()
    {
       return $this->hasMany(User::class);
    }

->>> $profession = Profession::first();

->>> $profession->users;

->>> $user->refresh();

->>> $profession->refresh();

->>> $user->profession;

->>> $user->profession();

->>> $profession->users;

->>> $profession->users();

->>> $profession->users()->where('is_admin',true)->get();

->>> User::where(['profession_id' => 1, 'is_admin' => true])->get();

Lesson 18 - Generate records using Model Factories in Laravel

$ php artisan tinker

->>> use \App\Models\User;

->>> factory(User::class)->create();

->>> use \App\Models\Profession;

->>> factory(User::class)->create([

    'profession_id' => Profession::whereTitle('Desarrollador front-end')->value('id')

]);

->>> factory(User::class)->([

       'name' => 'Another user',

       'email' => 'another@gmail.com',

       'password' => bcrypt('123456'),

       'profession_id' => Profession::whereTitle('Desarrollador front-end')->value('id')

]);

->>> factory(User::class)->([

       'email' => 'another@gmail.com',

       'password' => bcrypt('123456'),

       'profession_id' => Profession::whereTitle('Desarrollador front-end')->value('id')

]);

$ php artisan make:factory ProfessionFactory

$ php artisan help make:factory

$ php artisan make:factory ProfessionFactory --model=Profession

$ php artisan make:factory ProfessionFactory --model=Models/Profession

$ php artisan help make:model

$ php artisan make:model Skill -mf

Lesson 19 - Users module with Laravel (Introuction)

Lesson 20 - Dynamic List of Users with Laravel (CRUD Module)

$ php artisan migrate:fresh --seed

$ vendor/bin/phpunit

Lesson 21 - Database configuration and use in the automated testing environment Laravel and PHPUnit

$ php artisan migrate:fresh --seed

$ php artisan mig:fre --seed

$ php artisan mi:fr --seed

$ php artisan config:clear

$ vendor/bin/phpunit

Lesson 22 - Details or User Profile with Laravel (CRUD Module)

$ vendor/bin/phpunit

$ vendor/bin/phpunit --filter it_displays_the_usuers_details

Lesson 23 - Generate URLs in Laravel

$ vendor/bin/phpunit

Lesson 24 - 404 error handling in Laravel

$ vendor/bin/phpunit

Lesson 25 - Link models to routes in Laravel

$ vendor/bin/phpunit

Lesson 26 - Routes with POST and protection against CSRF attacks in Laravel

$ php artisan route:list

Lesson 27 - Creation of users with Laravel and TDD

$ vendor/bin/phpunit

//It passes the last test when only that one is run but not all together. (Done, solved.)

Lesson 28 - Create form to add users with Laravel





















































































































