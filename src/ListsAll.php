<?php


namespace ZhDan;


use ZhDan\Facade\ListsAllAction;
use ZhDan\Tool\HttpQuery;
use QL\QueryList;
class ListsAll implements ListsAllAction
{
    private $cookie;
    public function __construct(array $cookie)
    {
        $this->cookie = $cookie;
    }

    public function run()
    {
        $url = HttpQuery::getPathUri("Joinorder/lists_all");

        $html = QueryList::get($url);
    }
}