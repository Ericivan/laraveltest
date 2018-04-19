<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 15:02
 */

namespace Github;


use Github\Support\HasAttributes;
use Github\Exceptions\InvalidArgumentException;

class AccessToken implements \ArrayAccess,\JsonSerializable
{
    use HasAttributes;

    protected $token;

    protected $scope;

    public function __construct($attributes)
    {
        if (empty($attributes['access_token'])) {
            throw new InvalidArgumentException();
        }

        $this->attributes = $attributes;
    }


    public function getToken()
    {
        return $this->getAttribute('access_token');
    }

    public function jsonSerialize()
    {
        return $this->getToken();
    }

}