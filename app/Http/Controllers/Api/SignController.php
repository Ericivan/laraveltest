<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/11
 * Time: 下午4:09
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Reward;
use App\Sign;
use App\UserSign;
use Carbon\Carbon;

class SignController extends Controller
{

    function __construct()
    {
        $this->middleware('auth:api');
    }

    public function sign()
    {
        $time = Carbon::now()->toDateString();

        $isSigned = Sign::whereDate('created_at', $time)->first();

        if ($isSigned) {
            return response()->json([
                'code' => 1000,
                'message' => '今天你已经签到了',
            ]);
        }

        \DB::beginTransaction();

        try {

            $reward = Reward::getRewardByDate($time);

            Sign::create([
                'user_id' => \Auth::user()->id,
                'reward_id' =>$reward->id??0,
            ]);

             //TODO 用户道具表，把道具关联到用户下

            \DB::commit();
        } catch (\Exception $exception) {

            \DB::rollBack();

            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }


        return response()->json([
            'code' => 0,
            'message' => '签到成功',
        ]);
    }

    //用户签到列表
    public function signList()
    {
        $user = \Auth::user();

        $list=UserSign::where('user_id', $user->id)
            ->selectRaw(\DB::raw('date(created_at) as date'))
            ->get();

        $timeInterval = $this->getMonthDate(4);

        $signList=$timeInterval->map(function ($item) use ($list) {
            $curentDate = $list->where('date', $item['date'])->first();

            $return = [
                'date' => $item['date'],
            ];

            is_null($curentDate) ? $return['state'] = 0 : $return['state'] = 1;

            return $return;
        });


        return response()->json($signList->toArray());
    }


    //补签任务完成，进行补签
    public function reSigned()
    {
        $reSignedDate = request('date');

        $timeInterval = $this->getMonthDate(4)->pluck('date')->toArray();

        if (!in_array($reSignedDate, $timeInterval)) {
            throw new \Exception('invalid date');
        }

        //TODO 不能补签比时间比今天大的，一天只能补签一次


        $reward = Reward::getRewardByDate($reSignedDate);

        Sign::create([
            'user_id' => \Auth::user()->id,
            'reward_id' =>$reward->id??0,
            'created_at' => $reSignedDate,
        ]);
    }

    protected function getMonthDate($month)
    {
        $start=Carbon::now()->month($month)->startOfMonth();

        $end = Carbon::now()->month($month)->endOfMonth();

        $timeInterval = collect();


        while ($start <= $end) {
            $timeInterval->push(['date'=>$start->toDateString()]);

            $start = $start->addDay();
        }

        return $timeInterval;
    }
}