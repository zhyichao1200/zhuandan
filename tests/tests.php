<?php
require '../vendor/autoload.php';
use ZhDan\Login;

$model = new Login("19932997957","15132507912lixu");

$res = $model->run();

!$res->getOk() and die($res->getMessage());

var_dump($res->getData());