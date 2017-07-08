<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class AdminRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'account:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '添加管理员账号';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $admin = User::where('username', 'admin')->first();

        if ($admin) {
            $this->error('管理员已创建');
            return ;
        }

        $password = $this->secret('请输入管理员密码');
        $password_confirm = $this->secret('请重复输入管理员密码');

        if ($password == $password_confirm) {
            User::create([
                'nickname' => '杰洛',
                'username' => 'admin',
                'password' => $password,
                'sex'      => 0,
                'mail'     => 'admin@drakframe.com',
                'role'     => 0,
            ]);
            $admin = User::where('username', 'admin')->first();
        }

        $result = ! is_null($admin);
        if ($result) {
            $this->info('创建成功');
        } else {
            $this->error('创建失败，请检查日志');
        }
    }
}
