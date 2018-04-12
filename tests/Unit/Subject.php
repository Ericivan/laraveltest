<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/10
 * Time: 下午3:34
 */

namespace Tests\Unit;


class Subject
{
    protected $observers = [];

    protected $name;


    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function attach($obverser)
    {
        $this->observers[] = $obverser;
    }

    public function doSomethingBad()
    {
        foreach ($this->observers as $observer) {
            $observer->reportError(42, 'Something bad happened', $this);
        }
    }


    public function doSomethine()
    {
        $this->notify('something');
    }
    public function notify($arg)
    {
        foreach ($this->observers as $observer) {
            $observer->update($arg);
        }
    }
}

