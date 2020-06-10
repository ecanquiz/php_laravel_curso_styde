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














