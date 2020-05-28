<?php


namespace ZhDan\Model;


class Result extends Model
{
    protected $ok;
    protected $message;
    protected $data;
    protected $can;
    public function __construct($ok,$message,$data,$can)
    {
        $this->ok = $ok;
        $this->message = $message;
        $this->data = $data;
        $this->can = $can;
    }
}