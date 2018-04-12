<?php

namespace App\Pipes;

use Closure;
interface Pipe
{
    public function handle($content, Closure $closure);
}