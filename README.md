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










