<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/8
 * Time: 上午11:26
 */

namespace App\CacheExtend;

use Illuminate\Contracts\Cache\Store as CacheStore;

class CusRedisStore implements  CacheStore
{
    public function get($key)
    {
        return  'get cache in cusRedisStore';
    }

    public function many(array $keys)
    {
        // TODO: Implement many() method.
    }

    public function put($key, $value, $minutes)
    {
        // TODO: Implement put() method.
    }

    public function putMany(array $values, $minutes)
    {
        // TODO: Implement putMany() method.
    }

    public function increment($key, $value = 1)
    {
        // TODO: Implement increment() method.
    }

    public function decrement($key, $value = 1)
    {
        // TODO: Implement decrement() method.
    }

    public function forever($key, $value)
    {
        // TODO: Implement forever() method.
    }

    public function forget($key)
    {
        // TODO: Implement forget() method.
    }

    public function flush()
    {
        // TODO: Implement flush() method.
    }

    public function getPrefix()
    {
        // TODO: Implement getPrefix() method.
    }

}