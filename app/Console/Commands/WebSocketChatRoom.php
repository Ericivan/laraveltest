<?php

namespace App\Console\Commands;

use App\ChatUser;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Swoole\Server;

class WebSocketChatRoom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:room2';

    protected $avatar = [
        '/images/avatar/1.jpg',
        '/images/avatar/2.jpg',
        '/images/avatar/3.jpg',
        '/images/avatar/4.jpg',
        '/images/avatar/5.jpg',
        '/images/avatar/6.jpg'
    ];

    protected $name = [
        '科比',
        '库里',
        'KD',
        'KG',
        '乔丹',
        '邓肯',
        '格林',
        '汤普森',
        '伊戈达拉',
        '麦迪',
        '艾弗森',
        '卡哇伊',
        '保罗'
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $server = new \swoole_websocket_server('0.0.0.0', 9501);

        $server->on('open', [$this, 'open']);

        $server->on('message', [$this, 'messsage']);

        $server->on('close', function ($server, $fd) {

        });

        $server->start();

    }

    private function open(Server $server,$request)
    {
        var_dump(1);
        $path = storage_path();

        $user = [
            'fd' => $request->fd,
            'name' => array_rand($this->name) . $request->fd,
            'avatar' => $path . array_rand($this->avatar),
        ];

        ChatUser::create($user);

        $server->push($request->fd, json_encode(
            array_merge(['user'=>$user,['all'=>$this->allUser()],['type'=>'openSuccess']])
        ));
    }

    private function allUser()
    {
        return ChatUser::all()->toArray();
    }

    /**
     * @param Server $server
     * @param $message
     * @param $messageType
     * @param $frameFd
     * @author :Ericivan
     * @name : pushMessage
     * @description 遍历发送消息
     */
    private function pushMessage(Server $server, $message, $messageType, $frameFd)
    {
        $message = htmlspecialchars($message);

        $datetime = Carbon::now()->toDateTimeString();

        $user = ChatUser::getUserByFd($frameFd);

        $users =ChatUser::all();

        $send = json_encode([
            'type' => $messageType,
            'message' => $message,
            'datetime' => $datetime,
            'user' => $user,
        ]);

        $users->each(function ($item)use($frameFd,$server,$send) {
            if ($frameFd != $item->fd) {
                $server->push($item->fd,$send);
            }
        });


    }

    private function close(Server $server,$fd)
    {

    }

}
