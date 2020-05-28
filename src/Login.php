<?php


namespace ZhDan;

use ZhDan\Facade\LoginAction;
use GuzzleHttp\Client;
use ZhDan\Model\Result;
use ZhDan\Tool\HttpQuery;
use ZhDan\Cache\FileStore;
use ZhDan\Facade\CacheAction;
class Login implements LoginAction
{
    private $username;
    private $password;
    private $cache;
    public function __construct(string $username,string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $dir = "./user/";
        $this->cache = new FileStore($dir);
    }

    public function setCache($obj){
        if (!$obj instanceof CacheAction) throw new \Exception("cache设置错误");
        $this->cache = $obj;
    }

    private function store($data){
        return $this->cache->put($this->username,$data);
    }
    public function run(){
        $client = new Client();
        $url = HttpQuery::getPathUri("login");
        $response = $client->post($url,[
            "headers"=>[
                'X-Requested-With'=>'XMLHttpRequest',
                'isAjax'=>true
            ],
            "form_params"=>[
                "account"=>$this->username,
                "password"=>$this->password,
            ],
            'allow_redirects' => false,
        ]);
        $body = $response->getBody()->getContents();
        $body = json_decode($body,true);
        if (!$body) return new Result(false,"请求失败",null,false);
        if ($body["code"] != 0) return new Result(false,$body["msg"],null,false);
        $cookie = $response->getHeader('Set-Cookie');
        foreach($cookie as $index=>$item){
            $cookie[$index] = explode(";",$item);
            $cookie[$index] = $cookie[$index][0];
        }
        if (!$this->store($cookie)) return new Result(false,"缓存设置失败",null,false);
        return new Result(true,"获取成功",$cookie,false);
    }
}