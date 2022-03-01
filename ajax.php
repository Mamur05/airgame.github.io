<?php
define("FastCore", true);
define('BASE_DIR', $_SERVER['DOCUMENT_ROOT']);
$action = filter_var($_GET['action'],FILTER_SANITIZE_STRING);
if(file_exists(BASE_DIR.'/ajax/'.$action.'.php')){
    session_start();
    ###################################
# Я логгер
###################################
$log_post = var_export($_POST, true);
$log_get = var_export($_SERVER['REQUEST_URI'], true);
$log_ref = var_export($_SERVER['HTTP_REFERER'], true);
$log_ip = var_export($_SERVER['REMOTE_ADDR'], true);

$log = date('d.m в H:i') . ' - ' . $log_ip . ' - ' . $log_get . ' | '. $log_ref . ' POST '. $log_post; // что писать

$file_post = file_put_contents(__DIR__ . '/aimlogger/log_serf.txt', $log . PHP_EOL, FILE_APPEND); // пишет
###################################
	# Система
	spl_autoload_register(function ($name) {
		require (BASE_DIR.'/core/'.$name.'.php');
	});
    $config = new config;
    $func = new func;
    $db = new db($config->db_host, $config->db_user, $config->db_pass, $config->db_name);
    include(BASE_DIR.'/ajax/'.$action.'.php');
}else{
    echo 'Unknown request';
}