<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/19
 * Time: 下午8:21
 */

namespace Libraries\Weibo\Facades;


use Illuminate\Support\Facades\Facade;
use Libraries\Weibo\Contracts\Factory;

class WeiboLogin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}