<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/21
 * Time: 下午5:01
 */

namespace App\Libraries\User;


class RedisUser  implements UserInterface
{
    public function getUser()
    {
        return 'get User from redis';
    }

}