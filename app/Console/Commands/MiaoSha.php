<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class MiaoSha extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:miaosha';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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

        env();
        $ttl = 4;
        $random = mt_rand(1,1000).'-'.gettimeofday(true).'-'.mt_rand(1,1000);

        $lock = false;
        while (!$lock) {
            $lock = Redis::set('lock', $random,$ttl);
        }

        if (Redis::get('goods.num') <= 0) {
            echo ("秒杀已经结束");
            //删除锁
            if (Redis::get('lock') == $random) {
                Redis::del('lock');
            }
            return false;
        }

        Redis::decr('goods.num');
        echo ("秒杀成功");
        //删除锁
        if (Redis::get('lock') == $random) {
            Redis::del('lock');
        }
        return true;

    }
}
