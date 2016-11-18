<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'nickname' => '杰洛',
            'username' => 'admin',
            'password' => bcrypt(123456),
            'sex'      => 0,
            'mail'     => 'admin@drakframe.com',
            'role'     => 0,
        ]);
        factory(App\User::class)->times(9)->create();
        factory(App\Post::class)->times(10)->create();
        factory(App\Tag::class)->times(5)->create();
        factory(App\Comment::class)->times(20)->create();
    }
}
