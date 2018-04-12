<?php

namespace App\Http\Controllers\Api;

use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;
use liesauer\QLPlugin\SimpleForm;
use QL\Ext\PhantomJs;
use QL\QueryList;

class ExtractController extends Controller
{

    public function test()
    {
        dd('test');
    }
    public function weiboHotKeys()
    {

        $ql = QueryList::getInstance();

        $ql->use(PhantomJs::class, '/usr/local/Cellar/phantomjs/2.1.1/bin/phantomjs', 'browser');

        $html = $ql->browser('http://s.weibo.com/top/summary?Refer=top_hot&topnav=1&wvr=6')->getHtml();

        $rules = ['hot_keys' => ['p.star_name','html','a -i']];

        $data = $ql->rules($rules)->query()->getData();

        $insert = $data->map(function ($item) {
            return [
                'title' => $item['hot_keys'],
            ];
        })->toArray();

        \DB::table('weibo_hotkeys')->truncate();

        \DB::table('weibo_hotkeys')->insert($insert);

        return response()->json(['success']);


    }


    public function element()
    {
        $client = Client::getInstance();

        $client->getEngine()->setPath('/usr/local/Cellar/phantomjs/2.1.1/bin/phantomjs');

        $wd = urlencode('鸟哥');

        $request = $client->getMessageFactory()->createRequest("http://baidu.com/s?wd=$wd", 'GET');

        $response = $client->getMessageFactory()->createResponse();

        $client->send($request, $response);

        echo $response->getContent();
    }

    public function screenCapture()
    {
        $client = Client::getInstance();

        $client->getEngine()->setPath('/usr/local/Cellar/phantomjs/2.1.1/bin/phantomjs');

        $width  = 800;
        $height = 600;
        $top    = 0;
        $left   = 0;

        $request = $client->getMessageFactory()->createPdfRequest('http://baidu.com', 'GET');

        $request->setOutputFile(storage_path().'/baidu.pdf');
        $request->setViewportSize($width, $height);
        $request->setCaptureDimensions($width, $height, $top, $left);

        $response = $client->getMessageFactory()->createResponse();

        $client->send($request, $response);
    }

    public function responseData()
    {
        $client = Client::getInstance();

        $client->getEngine()->setPath(config('blog.phantom'));

        $request = $client->getMessageFactory()->createRequest('https://segmentfault.com', 'GET');

        $response = $client->getMessageFactory()->createResponse();

        $client->send($request, $response);

        dd($response->getUrl(),$response->getConsole());
    }

    public function customScript()
    {
        $scriptPath = app_path().'/Phantom/';
//        $scriptPath = '/Users/zhongzhiliang/Site/blog/vendor/jonnyw/php-phantomjs/src/JonnyW/PhantomJs/Resources/procedures';

        $serviceContainer = ServiceContainer::getInstance();

        $procedureLoader=$serviceContainer->get('procedure_loader_factory')->createProcedureLoader($scriptPath);

        $client = Client::getInstance();


        $client->getEngine()->setPath(config('blog.phantom'));

        $client->setProcedure('cus');

        $client->getProcedureLoader()->addLoader($procedureLoader);


//        $request = new \JonnyW\PhantomJs\Http\Request();

        $request = $client->getMessageFactory()->createRequest();
        $request->setUrl('http://baidu.com');
        $request->setMethod('GET');
        $response = $client->getMessageFactory()->createResponse();

        $client->send($request, $response);

        dd($response->getContent(), $client->getLog());
//        return response()->json(['success']);

    }

    public function domElemt()
    {
        $html = <<<STR
<div id="one">
    <div class="two">
        <a href="http://querylist.cc">QueryList官网</a>
        <img src="http://querylist.com/1.jpg" alt="这是图片" abc="这是一个自定义属性">
        <img src="http://querylist.com/2.jpg" alt="这是图片2">
    </div>
    <span>其它的<b>一些</b>文本</span>
</div>        
STR;

//        $ql = QueryList::getInstance()->setHtml($html);

        $ql = QueryList::html($html);

        $data = $ql->find('img')->attr('alt','被改过的图片');

        dd($data);

    }

    public function githubLogin()
    {
        $coookie = new CookieJar();

        $ql = QueryList::getInstance();

        $ql->use(SimpleForm::class);

        $username = $ql->simpleForm('https://github.com/login', '', [
            'options'=>[
                'verify' => false,
                'cookies' > $coookie,
            ]
        ],[
            'params'=>[
                'login' => 'ericivan',
                'password' => 'password',
            ],
            'options'=>[
                'verify' => false,
                'cookies' => $coookie,
            ]
        ])->find('.header-nav-current-user>.css-truncate-target')->text();

        if (!empty($username)) {
            echo "welcome back, {$username}!\n";
        } else {
            $error = $ql->find('.flash-error>.container')->text();
            echo "{$error}\n";
        }
    }
}

