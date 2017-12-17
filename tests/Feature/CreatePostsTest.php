<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreatePostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_cannot_create_threads()
    {
        $this->withExceptionHandling();
        $this->get('/posts/create')
            ->assertRedirect('/login');

        $this->post('/posts')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_post()
    {
        $this->actingAs(factory('App\User')->create());

        $post = factory('App\Post')->make();
        $response = $this->post('/posts', $post->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($post->title)
            ->assertSee($post->body);
    }

    /** @test */
    public function a_post_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_post_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }


    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()
            ->actingAs(factory('App\User')->create());
        $post = factory('App\Post')->make($overrides);
        return $this->post('/posts', $post->toArray());
    }
}
