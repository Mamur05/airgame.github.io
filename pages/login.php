<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt = array(
'title' => 'Вход',
'keywords' => 'вход в проекте',
'description' => 'вход, войти в аккаунт, войти'
);
//if(isset($_SESSION['uid'])){ Header('Location: /user/dashboard'); return; }
?>

<div class="wrapper" style="max-width: 490px;margin: 0 auto;">
<?php


/* Начало турнира */

$now = time();

$c_date = date("Ymd",time()); // Сегодня
$c_date_begin = strtotime($c_date." 00:00:00");
$c_date_end = strtotime($c_date." 23:59:59");

$y_date = date("Ymd",time()-24*60*60); // Вчера
$y_date_begin = strtotime($y_date." 00:00:00");
$y_date_end = strtotime($y_date." 23:59:59");

$db->query("SELECT * FROM db_liders WHERE date_add >='".$c_date_begin."' AND  date_add <='".$c_date_end."' ORDER BY id DESC LIMIT 1");
if($db->numRows() == 0) {

# Определеяем платежи за вчера
$sum_in = $db->query('SELECT SUM(sum) FROM db_insert WHERE `add` >= '.$y_date_begin.' AND `add` <= '.$y_date_end.' AND status = 1')->fetchAll();
foreach ($sum_in as $all) {
	$jackpot = round($all['SUM(sum)']/20,2);
}

# Настройки призов в процентах
$sum_p = array('1m' => '50', '2m' => '25', '3m' => '15', '4m' => '5', '5m' => '5');

$prize = array(1 => '0', 2 => '0', 3 => '0', 4 => '0', 5 => '0'); // null
$us = array(1 => '-', 2 => '-', 3 => '-', 4 => '-', 5 => '-'); // null
$counter = 1;

# Ищем активных за вчера
$ok = $db->query('SELECT uid, login, SUM(sum) as ssum FROM db_insert WHERE `add` >= '.$y_date_begin.' AND `add` <= '.$y_date_end.' AND status = 1 GROUP BY uid,login  ORDER by ssum DESC LIMIT 5')->fetchAll();

foreach($ok as $d) {
	$user_id = $d['uid'];
	$us[$counter] = $d['login'];
	$prize[$counter] = ($sum_p[$counter.'m']/100)*$jackpot;

	# Начисляем призы
	$db->query('UPDATE db_users SET money_b = money_b + '.$prize[$counter].' WHERE id = '.$user_id.'');
	$counter++;
}

# Вносим результаты конкурса
$db->query('INSERT INTO db_liders (1m, 2m, 3m, 4m, 5m, u1, u2, u3, u4, u5, bank, date_add) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)', array($prize[1], $prize[2], $prize[3], $prize[4], $prize[5], $us[1], $us[2], $us[3], $us[4], $us[5], $jackpot, $now));

}

/* Конец турнира */



# Форма входа
if (isset($_POST['auth']) ){
$email = $func->FMail($_POST['email']);
$pass = $func->FPass($_POST['pass']);

$time = time();

# Определить IP адрес
$real_ip = $func->get_ip();
$ip = $func->ip_int($real_ip);

# Валидация email
if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
	
# Ошибка когда поле не заполнено
if(!empty($_POST['email'] and $_POST['pass'])) {

# Проверка email
$eml = $db->query('SELECT * FROM db_users WHERE email = ?',array($email))->numRows();
if ($eml == 1) {
	
$data = $db->query('SELECT * FROM db_users WHERE email = ?',array($email))->fetchArray();
if(strtolower($data['pass']) == strtolower($pass)){
	
# Проверка на бан
if ($data['ban'] == 0) {
	
	} else { $errors[] = 'Ваш аккаунт был заблокирован!'; }
	} else { $errors[] = 'Пароль не совпадает!'; }
	} else { $errors[] = 'Email не зарегистрирован!'; }
	} else { $errors[] = 'Не все поля заполнены!'; }
	} else { $errors[] = 'Email заполнен неверно'; }
	
# Вывод ошибок
if (!empty($errors)) {
	echo '<div class="alert alert-danger"><i class="fa fa-warning"></i> '.array_shift($errors).'</div>';
}

# Успешный вход
else {
	$db->query('UPDATE db_users SET ip = ?, auth = ? WHERE email = ?',array($ip,$time, $email));

	# Делаем сесии
	$_SESSION['uid'] = $data['id'];
	$_SESSION['login'] = $data['login'];
	header('Location: /user/dashboard');return;
	}
}
?>

<form action="" method="POST" class="text-left">
<div class="form-group mb-2"><input class="form-control form-control-lg" name="email" placeholder="Email"></div>
<div class="form-group mb-2"><input type="password" class="form-control form-control-lg" name="pass" placeholder="Пароль"></div>

<button name="auth" type="submit" class="btn btn-success btn-lg">ВХОД</button>
<a class="btn btn-white" href="/restore">Забыли пароль?</a>
</form>

</div>



<div class="d-none d-lg-block"><div style="margin-top: 10%;"></div></div>
<div class="d-none d-md-block"><div style="margin-top: 5%;"></div></div>
