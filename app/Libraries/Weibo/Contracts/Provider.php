<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/19
 * Time: 下午8:23
 */

namespace Libraries\Weibo\Contracts;


interface Provider
{
    public function redirect();

    public function user();
}