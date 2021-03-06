<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdatePostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_who_made_first_like_can_update_post()
    {
        $this->withExceptionHandling();
        $this->actingAs($user = factory('App\User')->create());

        $post = factory('App\Post')->create([
            'user_id' => $user->id
        ]);
        $like = factory('App\Like')->create([
            'user_id' => $user->id,
            'liked_id' => $post->id
        ]);
        $this->patch("/posts/{$post->id}", [
            'title' => 'some title',
            'body' => 'some body'
        ])
            ->assertRedirect("/posts/{$post->id}");
    }

    /** @test */
    public function creator_cannot_update_post_if_not_like_first()
    {
        $this->withExceptionHandling();
        $this->actingAs($user = factory('App\User')->create());
        $post = factory('App\Post')->create();
        $this->patch("/posts/{$post->id}", [
            'title' => 'some title',
            'body' => 'some body'
        ])
            ->assertStatus(403);
    }

    /** @test */
    public function admin_can_update_any_post()
    {
        $this->withExceptionHandling();
        $this->actingAs($user = factory('App\User')->create(['name' => 'admin']));

        $post = factory('App\Post')->create();
        $this->patch("/posts/{$post->id}", [
            'title' => 'some title',
            'body' => 'some body'
        ])
            ->assertRedirect("/posts/{$post->id}");

    }

    /** @test */
    public function user_cannot_update_someone_else_post()
    {
        $this->withExceptionHandling();
        $this->actingAs($user = factory('App\User')->create());

        $post = factory('App\Post')->create();
        $this->patch("/posts/{$post->id}", [
            'title' => 'some title',
            'body' => 'some body'
        ])
            ->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_update_any_post()
    {
        $this->withExceptionHandling();

        $post = factory('App\Post')->create();

        $this->patch("/posts/{$post->id}", [
            'title' => 'some title',
            'body' => 'some body'
        ])
            ->assertRedirect('/login');
    }
}
