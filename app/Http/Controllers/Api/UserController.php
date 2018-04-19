<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/1/8
 * Time: 下午4:10
 */

namespace App\Http\Controllers\Api;


use App\Events\UserLogin;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\PipeRecord;
use App\Pipes\SaySomething;
use App\Pipes\UcFirst;
use App\User;
use Carbon\Carbon;
use Github\Facades\Github;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{


    public function test()
    {
        $user = User::find(1);

        event(new UserLogin($user));

        return response()->json([
            'message' => 'ok',
        ]);
    }

    public function queueTest()
    {
//        $redis = new \Redis();
//        $redis->connect('127.0.0.1');
//        $redis->auth('eric');
//
//        dd(json_decode($redis->zRange('queues:sendemail:delayed', 0, -1)[0]));
//
        Log::info('begin queue test');
        $user = User::find(1);

        $this->dispatch((new SendEmail($user))
//            ->delay(Carbon::now()->addSeconds(10))
//            ->onConnection('redis')
//            ->onQueue('high')
        );

        return response()->json(['success']);
    }

    public function create()
    {
        $pipe = [
            SaySomething::class,
            UcFirst::class,
        ];

        $content = 'hahahah';

       $return = app(Pipeline::class)
            ->send($content)
            ->through($pipe)
            ->then(function ($content) {
                return $content;
            });

        dd($return);
    }

    public function vue()
    {
        return view('vue');
    }


    public function github()
    {
        return Github::with('github')->redirect();
    }

    public function user()
    {
        /** @var \Github\User $user */
        $user = Github::with('github')->user();

        dd($user, $user->getId(), $user->getName());
    }
}