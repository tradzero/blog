<?php

namespace Tests\Www;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;
use App\User;

class PostTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    // 测试被删除的文章是否不可见
    public function testDeletedPosts()
    {
        $post = factory(Post::class)->create(['is_deleted' => 1]);

        $allPosts = Post::exist()->get();

        $result = $allPosts->contains($post);

        $this->assertFalse($result);

        // 测试访问该文章 预期 返回404
        $this->get(route('post.show', $post->id))
             ->assertStatus(404);
    }

    // 测试登录可见文章是否有效
    public function testLoginRequiredPosts()
    {
        $AuthRequiredPost = factory(Post::class)->create(['visible' => 1]);

        // 测试未登录 预期 返回的结果不包含该文章
        $NotLoginedPosts = Post::exist()->get();
        $NotLoginedResult = $NotLoginedPosts->contains($AuthRequiredPost);
        $this->assertFalse($NotLoginedResult);
        $this->get(route('post.show', $AuthRequiredPost->id))
             ->assertStatus(404);

        // 测试登录后 预期 返回的结果包含该文章
        $this->actingAs($this->getAuthenicatedUser());
        $LoginedPosts = Post::exist()->get();
        $LoginedResult = $LoginedPosts->contains($AuthRequiredPost);
        $this->assertTrue($LoginedResult);
        $this->get(route('post.show', $AuthRequiredPost->id))
             ->assertStatus(200);
    }

    public function testSelfSeeingPosts()
    {
        $self = $this->getAuthenicatedUser();
        $post = factory(Post::class)->create(['visible' => 2, 'user_id' => $self->id]);

        // 测试未登录用户无权查看
        $this->assertFalse(Post::exist()->get()->contains($post));
        $this->get(route('post.show', $post->id))
             ->assertStatus(404);
        
        // 测试其他用户无权查看私密文章
        $other = $this->getAuthenicatedUser();
        $this->actingAs($other);
        $this->assertFalse(Post::exist()->get()->contains($post));
        $this->get(route('post.show', $post->id))
             ->assertStatus(404);
        
        // 自己可以查看文章
        $this->actingAs($self);
        $this->assertTrue(Post::exist()->get()->contains($post));
        $this->get(route('post.show', $post->id))
             ->assertStatus(200);
    }

    public function testLike()
    {
        $oldPost = factory(Post::class)->create(['visible' => 0]);

        $oldLike = $oldPost->like;
        $oldUnlike = $oldPost->unlike;
        
        // 同时对同一文章进行两次操作 预期like数+1 unlike相同
        $this->patch(route('post.like', $oldPost->id), ['type' => false]);
        $this->patch(route('post.like', $oldPost->id), ['type' => true]);

        $currentPost = Post::find($oldPost->id);

        $currentLike = $currentPost->like;
        $currentUnlike = $currentPost->unlike;
        
        $this->assertEquals($currentLike, $oldLike + 1);
        $this->assertEquals($currentUnlike, $oldUnlike);
    }

    private function getAuthenicatedUser()
    {
        $user = factory(User::class)->create();

        return $user;
    }
}
