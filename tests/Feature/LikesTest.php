<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_can_not_likes_post()
    {
        $this->withExceptionHandling()
            ->post('posts/1/likes')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_like_any_post()
    {
        $this->actingAs(factory('App\User')->create());

        $post = factory('App\Post')->create();

        $this->post('posts/' . $post->id . '/likes');
        $this->assertCount(1, $post->likes);
    }

    /** @test */
    public function an_authenticated_user_can_unlike_post()
    {
        $this->actingAs(factory('App\User')->create());

        $post = factory('App\Post')->create();

        $this->post('posts/' . $post->id . '/likes');
        $this->assertCount(1, $post->likes);

        $this->delete('posts/' . $post->id . '/likes');
        $this->assertCount(0, $post->fresh()->likes);
    }

    /** @test */
    public function an_authenticated_user_may_only_like_a_post_once()
    {
        $this->actingAs(factory('App\User')->create());

        $post = factory('App\Post')->create();

        try {
            $this->post('posts/' . $post->id . '/likes');
            $this->post('posts/' . $post->id . '/likes');
        }catch (\Exception $exception){
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $post->likes);
    }
}
