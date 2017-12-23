<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DeletePostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function creator_can_delete_his_post()
    {
        $this->actingAs($user = factory('App\User')->create());

        $post = factory('App\Post')->create([
            'user_id' => $user->id
        ]);
        $this->delete("/posts/{$post->id}")
            ->assertRedirect('/posts');

    }

    /** @test */
    public function admin_can_delete_any_post()
    {
        $this->actingAs($user = factory('App\User')->create(['name' => 'admin']));

        $post = factory('App\Post')->create();
        $this->delete("/posts/{$post->id}")
            ->assertRedirect('/posts');

    }

    /** @test */
    public function user_cannot_delete_someone_else_post()
    {
        $this->withExceptionHandling();
        $this->actingAs($user = factory('App\User')->create());

        $post = factory('App\Post')->create();
        $this->delete("/posts/{$post->id}")
            ->assertStatus(403);

    }

    /** @test */
    public function guest_cannot_delete_post()
    {
        $this->withExceptionHandling();

        $post = factory('App\Post')->create();

        $this->delete("/posts/{$post->id}")
            ->assertRedirect('/login');
    }

}
