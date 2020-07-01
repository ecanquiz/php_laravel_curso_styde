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
        //$professionId = Profession::where('title', 'Desarrollador back-end')->value('id');
        //factory(User::class)->create([ 'profession_id' => $professionId ]);

        factory(User::class)->create([
            'name' => 'Joel'
        ]);

        factory(User::class)->create([
            'name' => 'Ellie'
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
    public function it_loads_the_usuers_details_page()
    {
        $this->get('/usuarios/5')
            ->assertStatus(200)
            ->assertSee('Mostrando detalles del usuario: 5');
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
