<?PHP
######################################
# Скрипт FastCore
# Мерчант PAYEER
# Автор Jumast & Kolyaka105
######################################

# Старт сессии
session_start();

###################################
# Я логгер
###################################
$log_post = var_export($_POST, true);
$log_get = var_export($_SERVER['REQUEST_URI'], true);
$log_ref = var_export($_SERVER['HTTP_REFERER'], true);
$log_ip = var_export($_SERVER['REMOTE_ADDR'], true);

$log = date('d.m в H:i') . ' - ' . $log_ip . ' - ' . $log_get . ' | '. $log_ref . ' POST '. $log_post; // что писать

$file_post = file_put_contents(__DIR__ . '/aimlogger/log_py.txt', $log . PHP_EOL, FILE_APPEND); // пишет
###################################

# Константа для Include
define('FastCore',true);

# Подгрузка классов
spl_autoload_register(function ($lfc) {
    require 'core/'.$lfc.'.php';
});

# Класс конфига
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->db_host, $config->db_user, $config->db_pass, $config->db_name);

if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;

if (isset($_POST["m_operation_id"]) && isset($_POST["m_sign"]))
{
	$m_key = $config->py_secret;
	$arHash = array($_POST['m_operation_id'],
		$_POST['m_operation_ps'],
		$_POST['m_operation_date'],
		$_POST['m_operation_pay_date'],
		$_POST['m_shop'],
		$_POST['m_orderid'],
		$_POST['m_amount'],
		$_POST['m_curr'],
		$_POST['m_desc'],
		$_POST['m_status'],
		$m_key);
	
	$sign_hash = strtoupper(hash('sha256', implode(":", $arHash)));
	if ($_POST["m_sign"] == $sign_hash && $_POST['m_status'] == "success")
	{
		$id = intval($_POST['m_orderid']); 
		$num = $db->query("SELECT * FROM `db_insert` WHERE `id` = '$id'")->numRows();

		if($num == 0) {	echo $_POST['m_orderid'].'|error'; exit(); }

		$data = $db->query("SELECT * FROM `db_insert` WHERE `id` = '$id'")->fetchArray();

		if($data['status'] == 1){ exit($_POST['m_orderid'].'|success');}
		if($data['sum'] != $_POST['m_amount']){ exit($_POST['m_orderid'].'|error');}

		$uid = $data['uid'];
		$sum = $data['sum'];
		$time = time();

		# Начисление с бонусом
		$bonx = $db->query("SELECT * FROM `db_percent` WHERE `type` = '1' ORDER BY `sum_a` BETWEEN {$sum} AND {$sum}
OR {$sum} BETWEEN `sum_a` AND `sum_b`")->fetchArray();

		$bonus = $bonx['sum_x'];
		$sum_x = ($sum + ($sum * $bonus));


# Билет при пополнени
if($sum >= 100 && $sum <= 15000) {
$billet = $sum / 100;
$billet = floor($billet);
} else {
$billet = 0;
}
		 # Обновляем пользователя
		$db->query("UPDATE `db_users` SET `sum_in` = `sum_in` + '$sum', `money_b` = `money_b` + '$sum_x', `freebet` = `freebet` + '$billet' WHERE `id` = '$uid'");

	# Реф-система
	$uref = new income_ref($db);
	$uref->uRef($uid, $sum);
	
	# Конкурс инвест
	$contest = new contest_inv($db);
	$contest->UpdatePoints($uid, $sum);

	# Конкурс реф
	$contest_ref = new contest_ref($db);
	$contest_ref ->UpdatePoints($uid, $sum);

		# Пишем в статистику
		$db->query("UPDATE `db_insert` SET `status` = '1',  `sum_x` = '$sum_x',  `end` = '.$time.'  WHERE `id` = '$id'");
		$db->query("UPDATE `db_stats` SET `inserts` = `inserts` + '$sum' WHERE `id` = '1'");

echo $_POST['m_orderid']."|success";// Успешно 
exit;
		
	}
	echo $_POST['m_orderid']."|error";// Отмена
}
?>