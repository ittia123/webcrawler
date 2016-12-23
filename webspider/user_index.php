<?php
//设置时区
date_default_timezone_set('Asia/Shanghai');
ini_set('display_errors', 1);
include "config.php";
include "cls_curl.php";
include "db.php";
include "cache.php";
include "worker.php";
include "user.php";

$w = new worker();
$w->count = 8;
$w->is_once = true;

$count = 100000;        // 每个进程循环多少次
$w->on_worker_start = function($worker) use ($count) {
    for ($i = 0; $i < $count; $i++) 
    {
        save_user_index($worker);
    }
}; 

$w->run();
