<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_not_handle_requests_for_unauthenticated_users()
    {
        //$this->withExceptionHandling();
        //$this->expectException(AuthenticationException::class);

        $this->withExceptionHandling();
        $response = $this->get('/api/users');
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function it_can_list_users()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user, 'api')
            ->get('/api/users');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'code' => 200,
                'message' => 'users_list',
            ])->assertJsonStructure([
                'data' => [
                    $user->getVisible()
                ]
            ]);
    }

    /**
     * @test
     */
    public function it_can_show_a_single_user()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user, 'api')
            ->get('api/users/' . $user->id);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'code' => 200,
                'message' => 'user',
            ])->assertJson([
                'data' => $user->toArray()
            ]);
    }

    /**
     * @test
     */
    public function it_can_create_a_new_user()
    {
        $user = factory(User::class)->create();

        $creating = factory(User::class)->raw([
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);

        $response = $this
            ->actingAs($user, 'api')
            ->post('api/users', $creating);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'code' => 200,
                'message' => 'user_created',
            ])->assertJson([
                'data' => [
                    'email' => $creating['email'],
                    'name' => $creating['name'],
                ]
            ]);
    }

    /**
     * @test
     */
    public function it_can_update_an_existing_user()
    {
        $user = factory(User::class)->create();
        $updating = factory(User::class)->raw();

        $response = $this
            ->actingAs($user, 'api')
            ->put('api/users/' . $user->id, $updating);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'code' => 200,
                'message' => 'user_updated',
            ])->assertJson([
                'data' => [
                    'name' => $updating['name'],
                    'email' => $updating['email'],
                ]
            ]);
    }

    /**
     * @test
     */
    public function it_can_delete_an_existing_user()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')
            ->delete('api/users/' . $user->id);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'code' => 200,
                'message' => 'user_deleted',
            ]);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }
}
