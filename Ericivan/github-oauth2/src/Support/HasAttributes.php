<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/19
 * Time: 15:16
 */

namespace Github\Support;


trait HasAttributes
{
    public $attributes;

    protected $default = null;

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->attributes);
    }

    public function offsetGet($offset)
    {
        return $this->getAttribute($offset);
    }

    public function getAttribute($offset)
    {
        return isset($this->attributes[$offset]) ? $this->attributes[$offset] : $this->default;
    }

    public function setAttribute($offset, $value)
    {
        $this->attributes[$offset] = $value;
        return $this;
    }

    public function offsetSet($offset, $value)
    {
        $this->setAttribute($offset, $value);

        return $this;
    }

    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    public function __get($property)
    {
        return $this->getAttribute($property);
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function jsonSerialize()
    {
        return json_encode($this->attributes, JSON_UNESCAPED_UNICODE);
    }
}