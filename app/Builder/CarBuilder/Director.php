<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/20
 * Time: 下午3:18
 */

namespace App\Builder\CarBuilder;


use App\Builder\CarBuilder\Part\Vehicle;

class Director
{
    public function build(BuilderInterface $builder):Vehicle
    {
        $builder->createVehicle();

        $builder->addDoor();

        return $builder->getVehicle();
    }
}