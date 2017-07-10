<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cache;

class ClearRedisCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除指定redis数据库数据';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $channel = $this->ask('请输入要清除的redis数据库频道 默认：cache', 'cache');
        if ($this->confirm('请确认要清除的是 ' . $channel)) {
            $redis = Cache::store('redis', '', $channel);
            $redis->flush();
            $this->info('清除成功');
        } else {
            return ;
        }
    }
}
