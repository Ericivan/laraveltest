<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/18
 * Time: 下午8:32
 */

namespace Github\Provider;

use Github\AccessToken;
use Github\Contracts\Provider as ProviderContract;
use Github\Support\Str;
use Github\User;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GithubProvider implements ProviderContract
{

    use ProviderAble;

    public $httpClient;

    public $baseApi = 'https://github.com';

    public $request;

    public $guzzle;

    protected $userApi = 'https://api.github.com';

    public function __construct(Request $request,$clientId,$clientSecret,$redirectUrl,$guzzle=[])
    {
        $this->request = $request;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUrl = $redirectUrl;
        $this->guzzle = $guzzle;
    }

    public function redirect()
    {
        return new RedirectResponse($this->getAuthUrl());
    }

    public function user()
    {
        $token = $this->getAccessToken();

        parse_str($token, $output);

        $accessToken = new AccessToken($output);

        $response = $this->getHttpClient()->get(
            $this->getUserApi() . '/user?access_token=' .$accessToken->getToken()
            )->getBody();

        $users = json_decode($response->getContents(), true);

        return new User($users);
    }

    protected function getUserApi()
    {
        return $this->userApi;
    }

    public function getCode()
    {
        return $this->request->input('code');
    }

    public function getRequestState()
    {
        return $this->request->input('state');
    }

    public function getAuthUrl()
    {
        return $this->baseApi . '/login/oauth/authorize?'.$this->buildQuery();
    }

    protected function buildQuery(array $array=[])
    {
        return http_build_query(array_merge($array,[
            'client_id' => $this->getClientId(),
            'redirect_url' => $this->getRedirectUrl(),
            'state' => $this->getState(),
        ]));
    }

    public function getAccessToken()
    {

        $api = $this->baseApi . '/login/oauth/access_token?' .$this->buildQuery([
                'client_secret' => $this->getClientSecret(),
                'code' => $this->getCode(),
                'state' => $this->getRequestState(),
            ]);

        $response = $this->getHttpClient()->post($api);


         //封装一个token类，用来获取user
        return $response->getBody()->getContents();
    }

    protected function getState()
    {
        return Str::random(20);
    }

    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = new Client($this->guzzle);
        }

        return $this->httpClient;
    }

}