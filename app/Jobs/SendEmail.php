<?php

namespace App\Jobs;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendEmail
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $user;

    protected $tries = 2;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('handel in sendemail');
        $user = $this->user;

        $user->remark = Carbon::now()->toDateTimeString();

        //重试测试
//        $user->heh = Carbon::now()->toDateTimeString();


        $user->save();
    }

    public function failed(\Exception $exception)
    {
        Log::error($exception->getMessage());
    }
}
