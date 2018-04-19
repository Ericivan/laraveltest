<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 15:30
 */

namespace Github\Exceptions;


use Throwable;

class InvalidArgumentException extends \InvalidArgumentException
{
    protected $message = 'The key "access_token" could not be empty.';

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->message, $code, $previous);
    }
}