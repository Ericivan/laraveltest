<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/21
 * Time: 下午5:00
 */

namespace App\Libraries\User;


class MysqlUser implements UserInterface
{
    public function getUser()
    {
        return 'get user from mysql';
    }

}