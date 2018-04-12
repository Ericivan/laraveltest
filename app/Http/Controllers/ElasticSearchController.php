<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Elasticsearch\ClientBuilder;
use Faker\Generator;
use Illuminate\Http\Request;
use Predis\Client;

class ElasticSearchController extends Controller
{
    //

    public function getAllUser()
    {
        return 'get User';
    }

    public function createIndex()
    {
        dd(uuid());
        $param = [
            'index' => 'laravel_index',
            'type' => 'laravel',
            'body' => [
                'age' => mt_rand(0,100),
                'name'=>$this->getRandName(),
                'date' => Carbon::now()->addYears(-mt_rand(1,50))->toDateString(),
            ],
        ];

        $client = ClientBuilder::create()->build();
        $response = $client->index($param);

        dd($response);
    }

    public function getIndex()
    {
        $param = [
            'index' => 'laravel_index',
            'type' => 'laravel',
            'scroll' => '30s',
            'size' => 10,
            'body' => [
                'query'=>[
                    'match_all' => new \stdClass(),
                ]
            ],

        ];

        $client = ClientBuilder::create()->build();

        $result = $client->search($param);


        return $result;
    }

    public function updateIndex()
    {
        $param = [
            'index' => 'laravel_index',
            'type' => 'laravel',
            'id' => 'AV_ioLH8ibaqhdWxM_WS',
            'body'=>[
                'doc' => [
                    'name' => 'ericivan',
                ],

            ]
        ];

        $client = ClientBuilder::create()->build();

        $response=$client->update($param);

        return response()->json($response);
    }

    public function getRandName()
    {
        $str = 'abcdefghijklnmopqrestuvsjdflj';

        $len = strlen($str)-1;
        $name = '';

        for ($i = 0; $i < 4; $i ++){
            $num = mt_rand(0, $len);

            $name .= $str[$num];
        }

        return $name;
    }

    public function search()
    {
        $client = ClientBuilder::create()->build();


        $param = [
            'index' => 'laravel_index',
            'type' => 'laravel',
            'body' => [
                'query'=>[
                    'constant_score' => [
                        'filter'=>[
                            'range'=>[
                                'age'=>[
                                    'gte' => 10,
                                    'lte' => 90,
                                ]
                            ]
                        ]
                    ],

                ]
            ],
        ];

        $result = $client->search($param);

        return $result;
    }
}
