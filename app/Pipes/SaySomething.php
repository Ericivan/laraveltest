<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/2/6
 * Time: 下午3:17
 */
namespace App\Pipes;

use Closure;

class SaySomething implements Pipe
{
    public function handle($content, Closure $closure)
    {
        $content = $content.'xiixi';
        return $closure($content);
    }

    public function hi()
    {
        return 'hi';
    }

}