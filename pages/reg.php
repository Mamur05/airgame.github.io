<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt = array(
'title' => 'Регистрация',
'keywords' => 'регистрация в проекте',
'description' => 'регистрация, создать аккаунт, войти'
);
$db->query("SELECT * FROM db_conf WHERE id = '1' LIMIT 1");
$cnf = $db->fetchArray();
if(isset($_SESSION['uid'])){ Header('Location: /user/dashboard'); return; }
?>

<div class="wrapper" style="max-width: 490px;margin: 0 auto;">
<?php

# Форма регистрации
if (isset($_POST['reg']) ){

# Фильтрация
$login = $func->FLogin(htmlspecialchars($_POST["login"]));
$email = $func->FMail($_POST["email"]);
$pass = $func->FPass($_POST["pass"]);

# Хешируем пароль
//$pass = password_hash($pass_d, PASSWORD_DEFAULT);

$time = time();

# Парсим HTTP REFERER
if (!empty($_COOKIE['rsite'])) $rsite = $_COOKIE['rsite'];
$host = parse_url($rsite);
$site = $host['host'];

# Присваиваем REFERER ID
$rid = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
$referer = '';

if($rid != 1){
$ref= $db->query("SELECT login FROM db_users WHERE id = '$rid' LIMIT 1")->numRows();
if($ref > 0){
$rname = $db->query("SELECT login FROM db_users WHERE id = '$rid' LIMIT 1")->fetchArray();
$referer = $rname['login'];

} 
else { $rid = 1; $referer = "Admin"; }
} 
else{ $rid = 1; $referer = "Admin";}


# Определить IP адрес
$real_ip = $func->get_ip();
$ip = $func->ip_int($real_ip);

# Ошибка логин
if(!empty($login)) {

# Ошибка email
if(!empty(filter_var($email, FILTER_VALIDATE_EMAIL) !== false)) {

# Ошибка пароля
if(!empty($pass)) {

# Проверка ip
$ipreg = $db->query('SELECT * FROM db_users WHERE ip = ?',array($ip))->numRows();
if ($ipreg == 0){

# Проверка логин
$log = $db->query('SELECT * FROM db_users WHERE login = ?',array($login))->numRows();
if ($log == 0){

# Проверка email
$eml= $db->query('SELECT * FROM db_users WHERE email = ?',array($email))->numRows();
if ($eml == 0) {

	} else { $errors[] = 'Такой Email уже зарегистрирован!'; }
	} else { $errors[] = 'Такой логин уже существует!'; }
	} else { $errors[] = 'Регистрация с этого IP ('.$real_ip.') уже производилась!'; }
	} else { $errors[] = 'Ошибка заполнения пароля!'; }
	} else { $errors[] = 'Ошибка заполнения email!'; }
	} else { $errors[] = 'Ошибка заполнения логин!'; }

# Вывод ошибок
if (!empty($errors)) {
	echo '<div class="alert alert-danger"><i class="fa fa-warning"></i> '.array_shift($errors).'</div>';
}

# Успешная регистрация
else {
	# Лимиты
	$limit_pay = '2000';
	$limit_today = '6';

	# За регистрацию персонаж
	$title = 'URAL AIRLINES';
	$speed = '0.0040';
	$time = time();
	$end = $time+60*60*24*30;

	# Создаем нового пользователя
	$db->query('INSERT INTO db_users (login, email, pass, reg, ip, rid, referer, refsite, speed, last, pay_limit, today_limit) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)', array($login, $email, $pass, $time, $ip, $rid, $referer, $site, $speed, $time, $limit_pay, $limit_today));
	$lid = $db->LastInsert();

	$db->query("INSERT INTO db_store (uid, tarif, title, speed, level, `add`, `end`, `last` ) VALUES ('$lid', '1', '$title', '$speed', '1', '$time', '$end', '$time')");

	# Создаем таблицу кошельков
	$db->query('INSERT INTO db_purse (id, time) VALUES (?,?)', array($lid, $time));

	# Прибавляем рефоводу +1
//	$speed_ref = '0.0010';
	$db->query('UPDATE `db_users` SET `refs` = `refs` + 1 WHERE `id` = '.$rid.'');

	# Пишем в статистику
	$db->query("UPDATE `db_stats` SET `users` = `users` + 1 WHERE `id` = '1'");

	echo '<div class="alert alert-success"><b>Регистрация прошла успешно!</b><br/>Сейчас Вы попадете на страницу входа.</div></div></div>';
	header('Refresh: 3; URL=/login');return;
	}
}
?>
<form action="" method="POST">
<div class="form-group mb-2"><input class="form-control form-control-lg" name="login" type="text" placeholder="Логин" value=""></div>
<div class="form-group mb-2"><input class="form-control form-control-lg" name="email" type="email" placeholder="Email" value=""></div>
<div class="form-group mb-2"><input class="form-control form-control-lg" name="pass" type="password" placeholder="Пароль" value=""></div>
<center>
<button name="reg" type="submit" class="btn btn-danger btn-lg">ЗАРЕГИСТРИРОВАТЬСЯ</button>
</center>
</form>
</div>

<div class="d-none d-lg-block"><div style="margin-top: 5%;"></div></div>
<div class="d-none d-md-block"><div style="margin-top: 5%;"></div></div>
