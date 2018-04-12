<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'say:hello {user=eric}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'say hello to somebody';

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
        $name = $this->choice('What is your name?', ['Taylor', 'Dayle'], false);

        echo $name;
    }
}
