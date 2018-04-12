<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/10
 * Time: 下午3:34
 */

namespace Tests\Unit;


class Observer
{
    public function update($arg)
    {
        //do something
    }

    public function reportError($errorCode,$errorMessage,Subject $subject)
    {
        //do something
    }
}

