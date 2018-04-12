<?php

namespace Tests\Unit;


use App\Builder\CarBuilder\CarBuilder;
use App\Builder\CarBuilder\Director;
use App\Builder\CarBuilder\Part\Car;
use App\CacheExtend\CusRedisStore;
use App\Libraries\User\MysqlUser;
use App\Libraries\User\UserManager;
use App\Reward;
use Carbon\Carbon;
use Illuminate\Cache\Repository;
use Tests\TestCase;
use Cache;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testQuickSort()
    {
        $arr = [4, 7, 1, 8, 3, 9];

        dd($this->quickSort($arr));

    }

    public function quickSort($arr)
    {
        if (!isset($arr[1])) {
            return $arr;
        }

        $baseNum = $arr[0];
        $leftArr = [];
        $rightArr = [];

        foreach ($arr as $v) {
            if ($baseNum > $v) {
                $leftArr[] = $v;
            }
            if ($baseNum < $v) {
                $rightArr[] = $v;
            }
        }

        $leftArr = $this->quickSort($leftArr);

        $leftArr[] = $baseNum;

        $rightArr = $this->quickSort($rightArr);

        return array_merge($leftArr, $rightArr);
    }

    public function testCarBuilder()
    {
        $carBuilder = new CarBuilder();

        $car = (new Director())->build($carBuilder);

        $this->assertInstanceOf(Car::class, $car);
    }

    public function testPregMatch()
    {
        $line = '.11';

        $match = [];
        if (preg_match("/^\-{0,1}[0-9]{0,}\.[0-9]+$/", $line, $match)) {
            print_r('Match found');
        }

        print_r($match);
    }

    public function testEmail()
    {
        $pattern = '/^[0-9a-zA-Z]+@(([0-9a-zA-Z]+)[.])+[a-z]{2,4}$/i';
        $pattern2 = '/^([a-zA-Z0-9]{1,20})(([_-.])?([a-zA-Z0-9]{1,20}))*@([a-zA-Z0-9]{1,20})(([-_])?([a-zA-Z0-9]{1,20}))*(.[a-z]{2,4}){1,2}$/';

        $match = [];

        $str = '12312312@qq.com';
        preg_match($pattern, $str, $match);

        dd($match);
    }

    public function testUserInterface()
    {
        $userManager = new UserManager();

        $user = new MysqlUser();

        dd($userManager->getUser($user));
    }

    public function testPregSplit()
    {
        $str = '1a3bb44a2ac';

        $alpha = preg_split('/[a-z]/', $str,-1,PREG_SPLIT_NO_EMPTY);

        print_r($alpha);
    }

    public function testJwt()
    {
        $token=JWTAuth::attempt([
            'email' => 'zzl@easub.com',
            'password' => 'ericivan',
        ]);

        dd($token);
    }

    public function testCusCache()
    {
//        Cache::extend('cus', function ($app) {
//            return new Repository(new CusRedisStore());
//        });

        dd(app('url'));
        dd(Cache::driver('cus')->get('hah'));
    }

    public function testCreateRewards()
    {
        $name = [
            '100','200','300','400','7天会员卡'
        ];

        $rewardCollection = collect();
        $time = Carbon::now();


        foreach ($name as $key=>$item) {
            $rewardCollection->push([
                'name' => $item,
                'date' => $time->addDay($key)->toDateString(),
            ]);
        }

        Reward::insert($rewardCollection->toArray());

    }

    public function testTimeInterval()
    {
        $month = 1;
        $start=Carbon::now()->month($month)->startOfMonth();

        $end = Carbon::now()->month($month)->endOfMonth();

        $timeInterval = [];


        while ($start <= $end) {
            $timeInterval[] = $start->toDateString();

            $start = $start->addDay();
        }

        dd($timeInterval);

        return $timeInterval;
    }
}
