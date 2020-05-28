<?php


namespace ZhDan\Tool;


class HttpQuery
{
    const DOMAIN = "http://zhuandan.com/";
    /**
     * 拼接path路由
     * @param string $path
     * @param array $query
     * @return string
     */
    static public function getPathUri(string $path = "",array $query = []) :string {
        return empty($query) ? self::DOMAIN.$path : self::DOMAIN.$path . "?" . http_build_query($query);
    }
}