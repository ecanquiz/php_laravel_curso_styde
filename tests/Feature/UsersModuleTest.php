<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\Models\User;

class UsersModuleTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_shows_the_usuers_list()
    {

        Profession::create([ 'title' => 'Desarrollador back-end' ]);
        $professionId = Profession::where('title', 'Desarrollador back-end')->value('id');

        factory(User::class)->create([
            'name' => 'Joel',
            'profession_id' => $professionId
        ]);

        factory(User::class)->create([
            'name' => 'Ellie',
            'profession_id' => $professionId
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie');

    }

    /** @test */
    public function it_shows_a_default_message_if_the_usuers_list_is_empty()
    {
        //DB::table('users')->truncate();
        //$this->get('/usuarios?empty')
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay usuarios registrados');

    }

    /** @test */
    public function it_displays_the_usuers_details()
    {
        Profession::create([ 'title' => 'Desarrollador back-end' ]);
        $professionId = Profession::where('title', 'Desarrollador back-end')->value('id');

        $user = factory(User::class)->create([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'profession_id' => $professionId 
        ]);

        $this->get('/usuarios/' . $user->id)
            ->assertStatus(200)
            ->assertSee('Ernesto Canquiz')
            ->assertSee('cumacos@gmail.com');
    }

    /** @test */
    public function it_displays_a_404_error_if_user_in_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Página no encontrada');
    }


    /** @test */
    public function it_loads_the_new_usuers_page()
    {
        //$this->withoutExceptionHandling();

        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Creando nuevo usuario');
    }

}
