<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Profession;
use App\User;

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

        //$this->get('/usuarios/' . $user->id) // usuario/5
        $this->get("/usuarios/{$user->id}") 
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
        
        //$this->assertDatabaseHas('users', [  
        $this->assertCredentials([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'password' => '123456'        
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

    /** @test */
    public function the_email_is_required()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/',[
                'name' => 'Ernesto Canquiz',
                'email' => '',
                'password' => '123456'        
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors([
                  'email'=>'El campo correo eletrónico es obligatorio'
            ]);
        $this->assertEquals(0, User::count());        
    }

    /** @test */
    public function the_email_must_be_valid()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/',[
                'name' => 'Ernesto Canquiz',
                'email' => 'correo-no-valido',
                'password' => '123456'        
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors([
                'email' =>'El campo correo eletrónico debe ser válido'
            ]);
        $this->assertEquals(0, User::count());        
    }

    /** @test */
    public function the_email_must_be_unique()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'email' => 'cumacos@gmail.com',
        ]);

        $this->from('/usuarios/nuevo')
            ->post('/usuarios/',[
                'name' => 'Ernesto Canquiz',
                'email' => 'cumacos@gmail.com',
                'password' => '123456'        
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors([
                'email' =>'Ya existe un usuario con ese email'
            ]);
        $this->assertEquals(1, User::count());        
    }

    /** @test */
    public function the_password_is_required()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/',[
                'name' => 'Ernesto Canquiz',
                'email' => 'cumacos@gmail.com',
                'password' => ''        
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors([
                  'password'=>'El campo contraseña es obligatorio'
            ]);
        $this->assertEquals(0, User::count());        
    }

    /** @test */
    public function the_password_must_be_min_6_chrs()
    {
        $this->from('/usuarios/nuevo')
            ->post('/usuarios/',[
                'name' => 'Ernesto Canquiz',
                'email' => 'cumacos@gmail.com',
                'password' => '123'        
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors([
                  'password'=>'La clave debe ser mínimo de 6 caracteres'
            ]);
        $this->assertEquals(0, User::count());        
    }

    /** @test */
    public function it_loads_the_edit_usuer_page()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
//      usuarios/editar?id=5
//        $this->get('/usuarios/editar', ['id' => $user->id])
        $this->get("/usuarios/{$user->id}/editar") //usuarios/5/editar
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            //->assertViewHas('user', $user); - 'wasRecentlyCreated' => true + 'wasRecentlyCreated' => false
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });

    }

    /** @test */
    public function it_updates_a_user()
    {

        $user = factory(User::class)->create();

        //$this->withoutExceptionHandling();

        $this->put("/usuarios/{$user->id}",[
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'password' => '123456'        
        ])->assertRedirect("/usuarios/{$user->id}"); //])->assertRedirect(route('users.index'));      

        $this->assertCredentials([
            'name' => 'Ernesto Canquiz',
            'email' => 'cumacos@gmail.com',
            'password' => '123456'        
        ]);

   }

    /** @test */
    public function the_name_is_required_when_updating_the_user()
    {

//        $this->withoutExceptionHandling();
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

	$this->from("usuarios/{$user->id}/editar")
	    ->put("/usuarios/{$user->id}",[
                'name' => '',
                'email' => 'cumacos@gmail.com',
                'password' => '123456'        
        ])
        ->assertRedirect("usuarios/{$user->id}/editar")
        ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'cumacos@gmail.com']);
        
    }

    /** @test */
    public function the_email_must_be_valid_when_updating_the_user()
    {

//    $this->withoutExceptionHandling();
        $this->withExceptionHandling();

        $user = factory(User::class)->create(['name'=> 'Nombre inicial']);

	$this->from("usuarios/{$user->id}/editar")
	    ->put("/usuarios/{$user->id}",[
                'name' => 'Nombre Actualizado',
                'email' => 'correo-no-valido',
                'password' => '123456'        
        ])
        ->assertRedirect("usuarios/{$user->id}/editar")
        ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'Nombre Actualizado']);

    }

    /** @test */
    public function the_email_must_be_unique_when_updating_the_user()
    {
        self::markTestIncomplete();
	return;
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'email' => 'cumacos@gmail.com',
        ]);

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name' => 'Ernesto Canquiz',
                'email' => 'cumacos@gmail.com',
                'password' => '123456'        
            ])
            ->assertRedirect('usuarios/nuevo')
            ->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors([
                'email' =>'Ya existe un usuario con ese email'
            ]);
        $this->assertEquals(1, User::count());        
    }

    /** @test */
    public function the_password_is_required_when_updating_the_user()
    {
        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name' => 'Ernesto Canquiz',
                'email' => 'cumacos@gmail.com',
                'password' => ''        
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
	    ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', ['email' => 'cumacos@gmail.com']);

    }

}
