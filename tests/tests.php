<?php
require '../vendor/autoload.php';
use ZhDan\Login;
use ZhDan\ListsAll;

$model = new Login("19932997957","15132507912lixu");

$res = $model->run();

!$res->getOk() and die($res->getMessage());

$cookie = $res->getData();

$page = new ListsAll($cookie);

$page->run();