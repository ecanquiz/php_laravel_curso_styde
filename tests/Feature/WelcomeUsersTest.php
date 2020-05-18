<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    public function it_welcomes_usuers_with_nickname()
    {
        $this->get('/saludo/ernesto/cumacos')
            ->assertStatus(200)
            ->assertSee('Bienvenido Ernesto, tu apodo es cumacos');
    }

    /** @test */
    public function it_welcomes_usuers_without_nickname()
    {
        $this->get('/saludo/ernesto')
            ->assertStatus(200)
            ->assertSee("Bienvenido Ernesto");
    }
}
