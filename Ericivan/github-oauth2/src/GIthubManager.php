<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/18
 * Time: 下午8:49
 */

namespace Github;


use Github\Provider\GithubProvider;
use Illuminate\Support\Manager;

class GIthubManager extends Manager
{


    public function with($dirver)
    {
        return $this->driver($dirver);
    }


    public function getDefaultDriver()
    {
        throw new \InvalidArgumentException('No Socialite driver was specified.');
    }

    public function createGithubDriver()
    {
        $config = $this->app['config']['services.github'];
        $config['guzzle'] = [
            'verify' => __DIR__ . './cacert.pem',
        ];

        return $this->buildProvider(GithubProvider::class,$config);
    }

    protected function buildProvider($provider,$config)
    {
        return new $provider(
            $this->app['request'],
            $config['client_id'],
            $config['client_secret'],
            $config['redirect_url'],
            array_get($config,'guzzle',[])
        );
    }

}