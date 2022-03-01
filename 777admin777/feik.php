<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
?>
<h3>Фейки</h3>

<div class="row m-0">

<div class="col-lg-4 col-md-6 p-2">
<div class="card">
<div class="card-header p-2"><b>Пополнить фейку</b></div>
<div class="p-2">
<?PHP

if(isset($_POST['sum_add'])){

$sum = $_POST['sum'];
$uid = $_POST['uid'];

        if(!empty($sum)){ 

	 $rows = $db->query('SELECT * FROM db_users WHERE id = ?')->numRows();
	if ($rows == 0){

	# фейку фейк
	$time = time();
	$sum = round(floatval($_POST["sum"]),2);
	$sys = 'payeer';

	# Селектим фейка
	$feik = $db->query('SELECT * FROM db_users WHERE id = '.$uid.' LIMIT 1')->fetchArray();
	$fid = $feik['id'];
	$flogin = $feik['login'];

	# Начисление с бонусом
	$bonx = $db->query("SELECT * FROM `db_percent` WHERE `type` = '1' ORDER BY `sum_a` BETWEEN {$sum} AND {$sum}
OR {$sum} BETWEEN `sum_a` AND `sum_b`")->fetchArray();

	$bonus = $bonx['sum_x'];
	$sum_x = ($sum + ($sum * $bonus));

	# Начисляем баланс
	$db->query('UPDATE `db_users` SET `sum_in` = `sum_in` + '.$sum.' WHERE `id` = '.$fid.'');

	# В статистику попополнений
   	$db->query("INSERT INTO db_insert (uid, login, sum, sum_x, sys, `add`, status) VALUES ('$fid','$flogin','$sum','$sum_x','$sys','$time','1')");
	$db->query("UPDATE `db_stats` SET `inserts`= `inserts` + '$sum' WHERE 1");
	# Конкурс инвест
	$contest = new contest_inv($db);
	$contest->UpdatePoints($uid, $sum);

	# Конкурс реф
	$contest_ref = new contest_ref($db);
	$contest_ref ->UpdatePoints($uid, $sum);

	# Реф-система
	$uref = new income_ref($db);
	$uref->uRef($uid, $sum);
	
	# Вставляем статистику
	$db->query("UPDATE db_stats SET inserts = inserts + '$sum' WHERE id = '1'");
	echo '<div class="alert alert-success">Баланс пополнен!</div>'; 

}	else { echo '<div class="alert alert-danger">Введите логин!</div>'; }
}	else { echo '<div class="alert alert-danger">Укажите сумму</div>'; }
}
?>

<form action="" method="post" class="mb-0">
Сумма: <input type="text" value="10" name="sum" class="form-control">
Пользователь: <select name="uid" class="form-control">
<?php
$sum_add = $db->query("SELECT * FROM db_users WHERE fake = '1'")->fetchAll();
foreach ($sum_add as $ad) {
?>
	<option value="<?=$ad['id']; ?>"><?=$ad['login']; ?> (пополнено: <?=$ad['sum_in']; ?> руб)</option>
<?php
}
?>
</select>
<input type="submit" name="sum_add" class="btn btn-success mt-2" style="font-weight: bold;" value="ПОПОЛНИТЬ"> 
</form>
</div>
</div>
</div>


<div class="col-lg-4 col-md-6 p-2">
<div class="card">
<div class="card-header p-2"><b>Выплатить фейку</b></div>
<div class="p-2">
<?PHP


if(isset($_POST['sum_out'])){

$sum = $_POST['sum'];
$uid = $_POST['uid'];


// Начало проверки общей суммы за последние 30 дней
$tlast = time()-720*60*60;
$tnow = time();

$last_in = $db->query('SELECT SUM(sum) FROM db_insert WHERE `add` >= '.$tlast.' AND `add` <= '.$tnow.' AND status = 1 AND `uid` = '.$uid.'')->fetchArray();
$last_insert = round($last_in['SUM(sum)'],0);
// Конец проверки общей суммы за последние 30 дней


$dep = $last_insert;
$prc = 10;

$total = $dep / (100 / $prc);


echo $total;

        if(!empty($sum)){ 
if(0 <= $last_insert) {

	 $rows = $db->query('SELECT * FROM db_users WHERE id = ?')->numRows();
	if ($rows == 0){

	# фейку фейк
	$sum = round(floatval($_POST["sum"]),2);
	$sys = 'payeer';

	# Селектим фейка
	$feik = $db->query('SELECT * FROM db_users WHERE id = '.$uid.' LIMIT 1')->fetchArray();
	$fid = $feik['id'];
	$flogin = $feik['login'];

	$da = time();
	$dd = $da + 60*60*24*15;
	$ppid = '1';
	$purse = "P".rand(11100000,55559999);

	# Начисляем баланс
	$db->query('UPDATE `db_users` SET `sum_out` = `sum_out` + '.$sum.' WHERE `id` = '.$fid.'');

	# Вставляем запись в выплаты
	$db->query("INSERT INTO db_payout (uid, login, purse, sum, sys, `add`, `del`, status) VALUES ('$fid','$flogin','$purse','$sum','$ppid','$da','$dd','3')");

	# Вставляем статистику
	$db->query("UPDATE db_stats SET payments = payments + '$sum' WHERE id = '1'");
	echo '<div class="alert alert-success">Пользователю выплачено <b>'.$sum.' руб</b>!</div>'; 

}	else { echo '<div class="alert alert-danger">Введите логин!</div>'; }
}	else { echo '<div class="alert alert-danger">Для заказа выплат, необходима сумма пополнений за последние 30 дней!<br/><b>На данный момент Ваши пополнения '.$last_insert.' руб. Необходимая сумма минимум 50 руб.</b></div>'; }
}	else { echo '<div class="alert alert-danger">Укажите сумму</div>'; }
}
?>

<form action="" method="post" class="mb-0">
Сумма: <input type="text" value="10" name="sum" class="form-control">
Пользователь: <select name="uid" class="form-control">
<?php
$sum_out = $db->query("SELECT * FROM db_users WHERE fake = '1'")->fetchAll();
foreach ($sum_out as $ou) {
?>
	<option value="<?=$ou['id']; ?>"><?=$ou['login']; ?> (выплачено: <?=$ou['sum_out']; ?> руб)</option>
<?php
}
?>
</select>
<input type="submit" name="sum_out" class="btn btn-danger mt-2" style="font-weight: bold;" value="ВЫПЛАТИТЬ"> 
</form>
</div>
</div>
</div>



<div class="col-lg-4 col-md-12 p-2">
<div class="card">
<div class="card-header p-2"><b>Добавить пользователя</b></div>
<div class="p-2">
<?PHP

if(isset($_POST['user_add'])){

$login = $_POST['login'];
$email = $_POST['email'];
$ref_id = $_POST['ref_id'];

	if(!empty($login)){
        if(!empty($email)){

	$rows = $db->query('SELECT * FROM db_users WHERE login = ?',array($login))->numRows();
	if ($rows == 0){

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    } return $random_string;
}
	# фейку фейк
	$time = time();
	$site = 'sitename.ru';
	$passw = generate_string($permitted_chars, 10);

	# Селектим логин реферера
	$rname = $db->query("SELECT login FROM db_users WHERE id = '$ref_id' LIMIT 1")->fetchArray();
	$referer = $rname['login'];

	# Создается фейк
	$db->query("INSERT INTO db_users (email, login, pass, referer, rid, refsite, reg, fake) VALUES ('$email','$login','$passw','$referer','$ref_id','$site', '$time', '1')");

	# Создаем таблицу кошельков
	$db->query('INSERT INTO db_purse (time) VALUES (?)', array($time));

	# Рефереру добавляем
	$refb = '0.0002'; // скорости за реферала
	$db->query('UPDATE `db_users` SET `refs` = `refs` + 1, `speed` = `speed` + '.$refb.'  WHERE `id` = '.$ref_id.'');

	# Вставляем статистику
	$db->query("UPDATE db_stats SET users = users +1 WHERE id = '1'");
	echo '<div class="alert alert-success">Фейковый пользователь добавлен!</div>'; 

}	else { echo '<div class="alert alert-danger">Такой логин занят!</div>'; }
}	else { echo '<div class="alert alert-danger">Почта не заполнена!</div>'; }
}	else { echo '<div class="alert alert-danger">Логин не заполнен!</div>'; }
}
?>

<form action="" method="post" class="mb-0">
Логин: <input type="text" value="" name="login" class="form-control">
Почта: <input type="text" value="" name="email" class="form-control">
Реферер: <select name="ref_id" class="form-control">
<?php
$feik_add = $db->query("SELECT * FROM db_users WHERE fake = '1'")->fetchAll();
foreach ($feik_add as $fu) {
?>
	<option value="<?=$fu['id']; ?>"><?=$fu['login']; ?></option>
<?php
}
?>
</select>
<input type="submit" name="user_add" class="btn btn-primary mt-2" style="font-weight: bold;" value="СОЗДАТЬ ФЕЙКА"> 
</form>
</div>
</div>
</div>

</div>


<center class="card p-2 m-2">
<h5 class="card-title">Список фейков</h5>
<table class="table table-striped table-sm table-bordered mb-0 text-center" style="width:70%;">
<thead>
	<th>ID</th>
	<th>Логин</th>
	<th>Пополнено</th>
	<th>Выплачено</th>
	<th>Регистрация</th>
</thead>
<?php
$flist = $db->query("SELECT * FROM db_users WHERE fake = '1' ORDER BY sum_in DESC")->fetchAll();
foreach ($flist as $fl) {
?>
<tr>
 	<td><?=$fl['id']; ?></td>
	<td><?=$fl['login']; ?></td>
	<td class="text-success alert-success"><?=$fl['sum_in']; ?></td>
	<td class="text-danger alert-danger"><?=$fl['sum_out']; ?></td>
	<td><?=date("d-m-Y в H:i",$fl['reg']); ?></td>
</tr>
<? } ?>
</table>
</center>