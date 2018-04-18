<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/18
 * Time: 下午10:05
 */

namespace Github\Facades;


use Github\Contracts\Factory;
use Illuminate\Support\Facades\Facade;

class Github extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}