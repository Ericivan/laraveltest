<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/21
 * Time: 下午5:03
 */

namespace App\Libraries\User;


class UserManager
{
    public function getUser(UserInterface $user)
    {
        return $user->getUser();
    }
}