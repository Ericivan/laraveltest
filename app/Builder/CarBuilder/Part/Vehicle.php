<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/20
 * Time: 下午3:01
 */

namespace App\Builder\CarBuilder\Part;


abstract class Vehicle
{
    private $data;

    public function setPart($key,$value)
    {
        $this->data[$key] = $value;
    }

}