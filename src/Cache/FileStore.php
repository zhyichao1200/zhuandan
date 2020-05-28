<?php


namespace ZhDan\Cache;

use ZhDan\Facade\CacheAction;
class FileStore implements CacheAction
{
    private $path;
    public function __construct($path)
    {
        $this->path = trim($path,"/") . "/";
        $this->path = str_replace("\\","/",$this->path);
        !is_dir($this->path) and mkdir($this->path,"0777",true);
    }

    private function fullDir($key){
        return $this->path.$key.".json";
    }

    public function get($key){
        return json_decode(file_get_contents($this->fullDir($key)),true);
    }
    public function put($key,$data){

        return file_put_contents($this->fullDir($key),is_string($data) ? $data : json_encode($data));
    }
}