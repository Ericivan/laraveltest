<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/19
 * Time: 下午8:22
 */

namespace Libraries\Weibo\WeiboLogin;


use Libraries\Weibo\Contracts\Provider as WeiboProvider;

abstract  class AbstractProvider implements WeiboProvider
{
    public function redirect()
    {
        // TODO: Implement redirect() method.
    }

    public function user()
    {
        // TODO: Implement user() method.
    }

}