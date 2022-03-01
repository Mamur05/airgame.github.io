<?php
if (!defined('FastCore') || FastCore !== true) { Header('Location: /404'); return; }
if (!isset($_SESSION['uid'])) { exit(); }
$type = filter_var($_GET['type'],FILTER_SANITIZE_STRING);
if(file_exists(BASE_DIR.'/ajax/links/'.$type.'.php')){
    $uid = $_SESSION['uid'];
	$login = $_SESSION['login'];
    $data = array();
    include(BASE_DIR.'/ajax/links/'.$type.'.php');
}else{
    echo 'Unknown request';
}