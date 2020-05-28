<?php


namespace ZhDan\Facade;


interface CacheAction
{
    public function get($key);
    public function put($key,$data);
}