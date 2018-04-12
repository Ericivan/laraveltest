<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/19
 * Time: 下午8:32
 */

namespace Libraries\Weibo\WeiboLogin;


interface ProviderInterface
{
    public function redirect();

    public function user();
}