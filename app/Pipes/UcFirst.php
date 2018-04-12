<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/2/6
 * Time: 下午4:00
 */

namespace App\Pipes;


use Closure;

class UcFirst implements Pipe
{
    public function handle($content, Closure $closure)
    {
        $content = ucwords($content);

        return $closure($content);
    }


}