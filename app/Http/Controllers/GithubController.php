<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/17
 * Time: 16:49
 */

namespace App\Http\Controllers;


use GuzzleHttp\Client;

class GithubController extends Controller
{

    public function redirect()
    {
        $api = 'https://github.com/login/oauth/authorize?';

        $query = http_build_query([
            'client_id' => 'dd5636af1d264b802c4e',
            'redirect_url' => 'http://127.0.0.1:2333/api/oauth2/callback',
            'state'=>'2fsdjfklj',
        ]);

        $redirect = $api . $query;

        return redirect($redirect);
    }

    public function callback()
    {

//        dd(request()->all());
        $query = [
            'client_id' => 'dd5636af1d264b802c4e',
            'client_secret' => 'a93a344b708e84842e5306f15dff2703d8ef6155',
            'code' => request('code'),
            'redirect_uri' => 'http://127.0.0.1:2333/api/oauth2/callback',
            'state' => request('state'),
        ];

        $client = new Client(['verify' => storage_path('/cacert.pem')]);

        $response = $client->post('https://github.com/login/oauth/access_token?' . http_build_query($query));

//        access_token=b758e07477c72bb20179eb9c8efcfdceb6a237ce&scope=&token_type=bearer
        dd($response->getBody()->getContents());

    }

    public function getUser()
    {
        echo 1;

        dd(1);
        $api = 'https://api.github.com/user?access_token=b758e07477c72bb20179eb9c8efcfdceb6a237ce';


        $response = (new Client(['verify' => storage_path('/cacert.pem')]))->get($api)->getBody();

        dd(json_decode($response->getContents(),true));
    }
}