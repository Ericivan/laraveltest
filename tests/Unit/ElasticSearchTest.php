<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/3/13
 * Time: 上午10:32
 */

namespace Tests\Unit;


use Elasticsearch\ClientBuilder;
use Tests\TestCase;

class ElasticSearchTest extends TestCase
{

    private $client;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $client = ClientBuilder::create()->build();

        $this->client = $client;
    }

    public function testCreate()
    {
        $param = [
            'index' => 'laravel_index',
            'type' => 'laravel',
            'id' => uuid(),
            'body' => [
                'name' => 'elastic-test'.mt_rand(0,100),
                'age' => mt_rand(0,100),
                'date' => '2017-01-01',
            ],
        ];

        $client = ClientBuilder::create()->build();

        $response=$client->create($param);

        print_r($response);

    }

    public function testSearch()
    {
        $param = [
            'index' => 'my_store',
            'type' => 'products',
            'body'=>[
                'query'=>[
                    'term'=>[
                        'price' => 20,
                    ]
                ]
            ]
        ];

        $result=$this->client->search($param);

        print_r($result);
    }

    public function testContantScoreSearch()
    {
        $param = [
            'index' => 'my_store',
            'type' => 'products',
            'body'=>[
                'query'=>[
                    'constant_score'=>[
                        'filter'=>[
                            'term'=>[
                                'price'=>20
                            ]
                        ]
                    ]
                ]
            ]
        ];

        print_r($this->client->search($param));
    }

    public function testTermSearch()
    {
        $param = [
            'index' => 'my_store',
            'type' => 'products',
            'body'=>[
                'query'=>[
                    'constant_score'=>[
                        'filter'=>[
                            'term'=>[
                                'productID'=>'XHDK-A-1293-#fJ3'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        print_r($this->client->search($param));

    }

    public function testIndexManage()
    {
        $param = [
            'index' => 'my_store',
            'body'=>[
                'setting' => [
                    'number_of_shards' => 3,
                    'number_of_replicas' => 2,
                ],
                'mappings'=>[
                    'pruducts'=>[
                        'properties' => [
                            'productID' => [
                                'type' => 'string',
                                'index' => 'not_analyzed',
                            ],
                            'price' => [
                                'type' => 'float',
                            ],
                        ],
                    ]
                ]
            ]
        ];

        dd($this->client->indices()->create($param));
    }

    /**
     * @author :Ericivan
     * @name : testCreateIndex
     * @description create index website
     */
    public function testCreateIndex()
    {
        $param = [
            'index' => 'website',
            'body'=>[
                'setting' => [
                    'number_of_shards' => 3,
                    'number_of_replicas' => 2,
                ],
                'mappings' => [
                    'blog'=>[
                        'properties'=>[
                            'title' => [
                                'type' => 'string',
                            ],
                            'text' => [
                                'type' => 'text',

                            ],
                            'tag' => [

                            ],

                        ]
                    ]
                ],
            ]

        ];

        dd($this->client->indices()->create($param));

    }

}