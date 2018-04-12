<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/19
 * Time: 下午8:25
 */

namespace Libraries\Weibo;


use Illuminate\Support\Manager;
use Libraries\Weibo\Contracts\Factory;

class WeiboManager extends Manager implements Factory
{


    public function with($driver)
    {
        return $this->driver($driver);
    }


    public function getDefaultDriver()
    {
        throw new \Exception('no default driver exists');
    }

}