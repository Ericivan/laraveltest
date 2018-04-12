<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/20
 * Time: 下午3:12
 */

namespace App\Builder\CarBuilder;


use App\Builder\CarBuilder\Part\Vehicle;

interface BuilderInterface
{
    public function createVehicle();

    public function addDoor();

    public function getVehicle():Vehicle;
}