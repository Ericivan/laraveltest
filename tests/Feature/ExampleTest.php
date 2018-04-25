<?php

namespace Tests\Feature;

use Illuminate\Support\Arr;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testArr()
    {
        $arr = ['a' => 1, 'b' => 2,'c'=>['d'=>['e'=>'sdfsdfsdf']]];

//        Arr::set($arr, 'c.d', 3);

        $this->arraySet($arr, 'c.d.e', 3);
        dd($arr);
    }

    public function arraySet(&$array,$key,$value)
    {
        if (is_null($key)) {
            return $array = $value;
        }

        $keys = explode('.', $key);

        while(count($keys) > 1){
            $key = array_shift($keys);

            if (!isset($array[$key]) || !is_array($key)) {
                $array[$key] = [];
            }


//            $array[$key] = $array;
            $array=&$array[$key];

//            dd($array);
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }
}
