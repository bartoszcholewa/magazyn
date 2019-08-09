<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaterialsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function only_logged_in_users_can_see_the_materials_index()
    {
        $response = $this->get('/materials')->assertRedirect('/login');
    }

    /** @test */
    public function logged_users_can_see_the_materials_index()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/materials')->assertOk();    
    }
}
