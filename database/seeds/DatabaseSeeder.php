<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateAllTables();
        
        $faker = Factory::create('zh-CN');
        App\User::create([
            'nickname' => '杰洛',
            'username' => 'admin',
            'password' => 123456,
            'sex'      => 0,
            'mail'     => 'admin@drakframe.com',
            'role'     => 0,
        ]);
        factory(App\User::class)->times(9)->create();
        factory(App\Tag::class)->times(5)->create();
        factory(App\Post::class)->times(10)->create()->each(function ($post) use ($faker) {
            $post->tags()->sync(
                // 随机为文章添加标签
                $faker->randomElements(range(1, 5), $count = rand(1, 3))
            );
        });
        factory(App\Comment::class)->times(20)->create();
    }
    
    private function truncateAllTables()
    {
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('comments')->truncate();
        DB::table('post_tag')->truncate();
    }
}
