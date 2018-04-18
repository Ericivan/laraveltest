<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/18
 * Time: 下午10:01
 */

namespace Github;


use Github\Contracts\Factory;
use Illuminate\Support\ServiceProvider;

class GithubServiceProvider extends ServiceProvider
{
    protected $defer=true;


    public function register()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new GIthubManager($app);
        });
    }

    public function provides()
    {
        return [Factory::class];
    }
}