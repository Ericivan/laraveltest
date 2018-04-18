<?php
/**
 * Created by PhpStorm.
 * User: zhongzhiliang
 * Date: 2018/4/18
 * Time: 下午8:39
 */

namespace Github\Provider;


trait ProviderAble
{
    public $redirectUrl;

    public $clientId;

    public $clientSecret;

    /**
     * @return mixed
     */
    public function getBaseApi()
    {
        return $this->baseApi;
    }

    /**
     * @param mixed $baseApi
     */
    public function setBaseApi($baseApi)
    {
        $this->baseApi = $baseApi;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @param mixed $redirectUrl
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param mixed $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }
}