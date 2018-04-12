<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ChatRroom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:room1';

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
        $ws = new \swoole_server('0.0.0.0', 9502,SWOOLE_BASE);

        $ws->set([
            'daemonize' => false,
        ]);
//        $ws->on('message', function ($ws, $frame) {
//            \Log::info('message callback');
//            echo "Message: {$frame->data}\n";
//            $ws->push($frame->fd, "server send msg {$frame->data}");
//        });

        $ws->on('close', function ($ws, $fd) {
            echo "client-{$fd} is closed\n";
        });

        $ws->on('connect', function (\swoole_server $ws, $fd, $reactorId) {
            \Log::info('ws connect');
            $connectList = $ws->connection_list();
            print_r($connectList);
        });

        $ws->on('receive', function (\swoole_server $ws, $frame) {
            \Log::info('receive callback');
            echo "Message: {$frame->data}\n";
            $ws->send($frame->fd, "server send msg {$frame->data}");
        });

        $ws->start();

    }
}
