<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/18
 * Time: 下午8:22
 */

namespace Github\Contracts;


interface Provider
{
    public function redirect();

    public function user();

}