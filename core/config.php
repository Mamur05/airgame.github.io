<?php //if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
class config{
	# База данных
	public $db_host = 'localhost';
	public $db_user = 'adsgop';
	public $db_pass = '%URegtF5';
	public $db_name = 'adsgop';

	# cron
	public $adm_dir = '777admin777'; // Директория
	public $adm_name = 'admin777'; // Логин
	public $adm_pass = '1234567890'; // Пароль
	
	# PAYEER
	public $py_shop = '115544332211'; // ID магазина
	public $py_secret = 'vV7943383JS453'; // SECRET ключ магазина
	public $py_NUM = 'P5000222222'; // Номер кошелька
	public $py_apiID = '11550550999'; // API ID
	public $py_apiKEY = 'Ga56kI97443IyIQ';// API KEY



	# Настройки сайта
	public $start_time = '1606140809';
	public $sitename = 'AirGame'; // Название
	public $email = 'po4ta@gmail.com'; // Почта

}
?>