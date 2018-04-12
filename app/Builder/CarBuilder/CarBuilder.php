<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/20
 * Time: 下午3:13
 */

namespace App\Builder\CarBuilder;



use App\Builder\CarBuilder\Part\Car;
use App\Builder\CarBuilder\Part\Door;
use App\Builder\CarBuilder\Part\Vehicle;

class CarBuilder implements BuilderInterface
{
    /** @var  Car */
    private $car;

    public function createVehicle()
    {

        $this->car = new Car();
    }

    public function addDoor()
    {
        $this->car->setPart('Right', new Door());
    }

    public function getVehicle(): Vehicle
    {
        return $this->car;
    }

}