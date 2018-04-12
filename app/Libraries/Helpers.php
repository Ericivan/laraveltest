<?php

if (!function_exists('uuid')) {

    function uuid()
    {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}