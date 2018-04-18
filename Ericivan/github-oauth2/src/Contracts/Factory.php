<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/18
 * Time: 下午8:20
 */

namespace Github\Contracts;


interface Factory
{
    public function driver($dirver=null);
}