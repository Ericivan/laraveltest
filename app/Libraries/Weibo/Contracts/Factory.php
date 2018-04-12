<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/19
 * Time: 下午8:20
 */

namespace Libraries\Weibo\Contracts;


interface Factory
{
    public function driver($driver = null);
}