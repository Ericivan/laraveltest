<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/19
 * Time: 下午8:26
 */

namespace Libraries\Weibo;


use Illuminate\Support\ServiceProvider;
use Libraries\Weibo\Contracts\Factory;


class WeiboLoginServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new WeiboManager($app);
        });
    }

    public function provides()
    {
        return [Factory::class];
    }
}