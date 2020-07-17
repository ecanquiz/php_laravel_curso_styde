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

        factory(User::class)->create([
            'name' => 'Joel',
        ]);

        factory(User::class)->create([
            'name' => 'Ellie',
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

        $user = factory(User::class)->create([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
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
            ->assertSee('Crear usuario');
    }

    /** @test */
    public function it_creates_a_new_user()
    {
        //$this->withoutExceptionHandling();

        $this->post('/usuarios/',[
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'password' => '123456'        
        ])->assertRedirect('usuarios'); //])->assertRedirect(route('users.index'));
        
        $this->assertDatabaseHas('users', [  //$this->assertCredentials([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
        ]);

    }

    /** @test */
    public function the_name_is_required()
    {

//        $this->withoutExceptionHandling(); //This must be disabled for Laravel to validate exceptions.

//        $this->post('/usuarios/',[
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/',[
                'name' => '',
                'email' => 'cumacos@gmail.com',
                'password' => '123456'        
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors([//'name'
                  'name'=>'El campo nombre es obligatorio'
            ]);

        $this->assertEquals(0, User::count());

//        $this->assertDatabaseMissing('users', [
//            'email' => 'cumacos@gmail.com'
//        ]);
        
    }

}
