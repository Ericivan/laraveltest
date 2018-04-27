<?php

namespace Tests\Unit;


use App\Builder\CarBuilder\CarBuilder;
use App\Builder\CarBuilder\Director;
use App\Builder\CarBuilder\Part\Car;
use App\CacheExtend\CusRedisStore;
use App\Libraries\User\MysqlUser;
use App\Libraries\User\UserManager;
use App\Reward;
use Carbon\Carbon;
use Illuminate\Cache\Repository;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Tests\TestCase;
use Cache;

class JwtTest extends TestCase
{

    protected static $rsaKeys;

    protected static $ecdsaKeys;

    public static function createRsaKeys()
    {
        $keychain = new Keychain();
        $dir = 'file://' . __DIR__;

        static::$rsaKeys = [
            'private' => $keychain->getPrivateKey($dir . '/rsa/private.key'),
            'public' => $keychain->getPublicKey($dir . '/rsa/public.key'),
            'encrypted-private' => $keychain->getPrivateKey($dir . '/rsa/encrypted-private.key', 'testing'),
            'encrypted-public' => $keychain->getPublicKey($dir . '/rsa/encrypted-public.key')
        ];
    }


    public static function createEcdsaKeys()
    {
        $keychain = new Keychain();
        $dir = 'file://' . __DIR__;

        static::$ecdsaKeys = [
            'private' => $keychain->getPrivateKey($dir . '/ecdsa/private.key'),
            'private-params' => $keychain->getPrivateKey($dir . '/ecdsa/private2.key'),
            'public1' => $keychain->getPublicKey($dir . '/ecdsa/public1.key'),
            'public2' => $keychain->getPublicKey($dir . '/ecdsa/public2.key'),
            'public-params' => $keychain->getPublicKey($dir . '/ecdsa/public3.key'),
        ];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testQuickSort()
    {
        $arr = [4, 7, 1, 8, 3, 9];

        dd($this->quickSort($arr));

    }


    public function testBuildToken()
    {
        $user = (object)['name' => 'test', 'eamil' => 'a@a.com'];



        $token = (new Builder())->setId(1)
            ->setAudience('http:/client.com')
            ->setIssuer('http://ap.com')
            ->setExpiration(time() + 3000)
            ->set('user', $user)
            ->getToken();

        dd($token);
    }

    /** @test */
    public function builderCanGenerateAToken()
    {
        $user = (object)['name' => 'test', 'eamil' => 'a@a.com'];

        $singer = new Sha256();

        static::createEcdsaKeys();

        dd(static::$ecdsaKeys['private']);

        $token = (new Builder())->setId(1)
            ->setAudience('http://client.abc.com')
            ->setIssuer('http://api.abc.com')
            ->set('user', $user)
            ->setHeader('jki', '1234')
            ->sign($singer, static::$ecdsaKeys['private'])
            ->getToken();

        dd($token);
    }

}
