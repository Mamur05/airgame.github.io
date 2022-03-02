<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

/***
 * Движок - FastCore v0.7 01.04.2020
 * Скрипт предназначен для свободного пользования.
 * Разработка и поддержка: Jumast & Kolyaka105 
 * Контакты: jumast@ya.ru - kolya105@ukr.net
 * Обновления тут:  https://vk.com/fastcore
 **/

# Генерация страницы
define('GenTime', microtime(true));

# Старт сессии
session_start();

# Старт буфера
ob_start();


###################################
# Я логгер
###################################
$log_post = var_export($_POST, true);
$log_get = var_export($_SERVER['REQUEST_URI'], true);
$log_ref = var_export($_SERVER['HTTP_REFERER'], true);
$log_ip = var_export($_SERVER['REMOTE_ADDR'], true);

$log = date('d.m в H:i') . ' - ' . $log_ip . ' - ' . $log_get . ' | '. $log_ref . ' POST '. $log_post; // что писать

$file_post = file_put_contents(__DIR__ . '/aimlogger/log.txt', $log . PHP_EOL, FILE_APPEND); // пишет
###################################

# HTTP REFERER
if(empty($_COOKIE['rsite'])) setcookie ('rsite', $_SERVER['HTTP_REFERER'],time()+(60*60*24*14),'/');

# Default title
$opt = array();

# Константа для Include
define('FastCore',true);

# Система
spl_autoload_register(function ($lfc) {
    require 'core/' . $lfc . '.php';
});

# Класс конфига
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->db_host, $config->db_user, $config->db_pass, $config->db_name);

# Пользователь
$uid = $_SESSION['uid'] ?? '0';
$login = $_SESSION['login'] ?? 'Guest';

# Директория админки
$adm = $config->adm_dir;

# Подключаем роуты
require('routes.php');

/**
* $routed_file - подключаем страницы через require() 
* $pg->segment[1] === 'add'; пример роута - '/page/add' => 'page.php',
* $pg->params[1] === 'add'; пример роута - '/page/([^/]+)' => 'page.php',
*/

# Подключаем роутер
$pg = new router();
$routed_file = $pg->classname;

# Пользователь
if (!empty($pg->segment[0] === 'user')) {

# Пользователь или не
if(isset($_SESSION['uid']) > 0) {
	# Если пользователь ищем в БД
	$user = $db->query('SELECT * FROM db_users WHERE id = ?',$uid)->fetchArray();
	
	require('inc/head.php'); // Шапка

	echo '<div class="container-body">';
	require('inc/menu.php'); // Меню аккаунта
	echo '<div class="content"><div class="shadow">';
	require('inc/title.php'); // Заголовок
	require('pages/user/'.$routed_file); // Страницы аккаунта
	echo '</div></div><div class="clearfix"></div>'; // див контент
	echo '</div>'; // див кабинет

	require('inc/foot.php'); // Подвал

} else {
	header('Location: /'); return; 
 }
}


# Админка
elseif (!empty($pg->segment[0] === ''.$adm.'') ?? $pg->segment[0] === ''.$adm.'') {

# Админ сессия
if(isset($_SESSION["admin"])){
	require('pages/'.$adm.'/inc/head.php'); // Шапка  админки
	require('pages/'.$adm.'/inc/menu.php'); // Шапка  админки
	require('pages/'.$adm.'/'.$routed_file); // Страницы  админки
	require('pages/'.$adm.'/inc/foot.php'); //Подвал  админки
}

# Если не админ
else {
	require('pages/'.$adm.'/inc/head.php'); // Шапка  админки
	require('pages/'.$adm.'/login.php'); // Вход в админку
 }
}

# IFRAME Серфинг
elseif (!empty($pg->segment[0] === 'link')) {
if(isset($_SESSION["uid"])){
	require('inc/view.php');
}
}

# Гости
else {
	require('inc/head.php'); // Шапка
	require('pages/'.$routed_file); // Страницы
	require('inc/foot.php'); // Подвал
}


# Заносим контент в переменную
$content = ob_get_contents();

# Очищаем буфер
ob_end_clean();

# Генерация страницы конец
$gen_page = round((microtime(true) - GenTime), 5);

# Заменяем данные
if (empty($pg->segment[0] === ''.$adm.'')) {  // off-admin
$content = str_replace('{!TITLE!}',$opt['title'],$content); 
}
if (empty($pg->segment[0] === 'user') && empty($pg->segment[0] === ''.$adm.'')) { // off-account
$content = str_replace('{!DESCRIPTION!}',$opt['description'],$content);
$content = str_replace('{!KEYWORDS!}',$opt['keywords'],$content); 
}
$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", ($gen_page)) ,$content);

# Выводим контент
echo $content;
?>