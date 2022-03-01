<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Бонус к скорости заработка';

# Бонус выдача
$dep = round($user['sum_in']);

# Уровни
if($dep <= 249) {$day = 1;}
elseif ($dep >= 250 and $dep < 999) {$day = rand(1,  10);}
elseif ($dep >= 1000) {$day = 10;}

# Настройки бонусов
$bonus_min = $day;
$bonus_max = $day;
?>
<div class="alert bg-light text-center">
Бонус выдается каждые 24 часов и добавляется к вашей скорости заработка.<br/>
Сумма бонуса генерируется случайно от <font class="text-danger"><b>0.0001</b></font> до <font class="text-danger"><b>0.001</b></font> руб/час.<br/>
Бонус зависит от суммы пополнения чем больше пополнено тем выше бонус.<br/>
<b class="text-danger text-uppercase" data-toggle="collapse" data-target="#lvl" style="cursor: pointer;"><i class="fa fa-question-circle" aria-hidden="true"></i> Таблица уровней бонуса:</b>

<div id="lvl" class="collapse alert-light text-dark">
Сумма пополнения меньше 250 руб. = <b>бонус 0.0001 руб/час.</b><br/>
Сумма пополнения 250 - 999 руб. = <b>бонус от 0.0002 до 0.001 руб/час.</b><br/>
Сумма пополнения свыше  1000 руб. = <b>бонус 0.001 руб/час.</b><br/>
</div>
</div>

<?PHP
$ddel = time() + 60*60*24;
$dadd = time();
$hide = false;

$true = $db->query("SELECT * FROM `db_bonus4` WHERE `uid` = '$uid' AND `del` > '$dadd'")->numRows();
if($true == 0){

# Выдача бонуса
if(isset($_POST["bonus"])){

	$sumlimit = 99; // заглушка
	if ($sumlimit < $user['sum_out']){

	$random = rand($bonus_min, rand($bonus_min, $bonus_max) );
	$sum = round($random/10000,4);
	# Зачилсяем бонус
	$db->query("UPDATE db_users SET `speed` = `speed` + '$sum' WHERE `id` = '$uid'");
	# Вносим запись в список бонусов
	$db->query('INSERT INTO db_bonus4 (`login`, `uid`, `sum`, `add`, `del`) VALUES (?,?,?,?,?)', array($login, $uid, $sum, $dadd, $ddel));
	# Случайная очистка устаревших записей
	$db->query("DELETE FROM db_bonus4 WHERE `del` < '$dadd'");
	echo '<script> swal("Успех!", "К вашей скорости добавлен бонус!", "success"); </script>';
	$hide = true;

	} else echo '<center><script> swal("Неудача!", "Бонус доступен при сумме выплат свыше 100 РУБ.!", "error"); </script></center>'; 
}

# Скрыть кнопку
if(!$hide){
?>
<center class="mb-1">
<b class="text-uppercase">Перейдите по баннеру и нажмите получить бонус</b><br/>
<div id="hidden_link" onclick="document.all.hidden_link1.style.display='block';" style="width: 468px;display:yes">
<div id="linkslot_291438"><script src="https://linkslot.ru/bancode.php?id=291438" async></script></div>
<div id="linkslot_291439"><script src="https://linkslot.ru/bancode.php?id=291439" async></script></div>
</div>
<div id="hidden_link1" onclick="document.all.hidden_link2.style.display='block';" style="display:none">
<form action="" method="post">
<input type="submit" name="bonus" value="Получить бонус" class="btn btn-lg btn-success mt-1">
</form>
</div>
</center>
<?PHP 
	}
}
else {
	$udata = $db->query("SELECT * FROM db_bonus4 WHERE uid = '$uid'")->fetchArray();

	# Таймер
	$dt=$udata['del']-time();
	$dd=(int)($dt/86400);
	$hh=(int)(($dt-$dd*86400)/3600);
	$mm=(int)(($dt-$dd*86400-$hh*3600)/60);
	$ss=(int)($dt-$dd*86400-$hh*3600-$mm*60);
?>
<center class="alert alert-success border-success text-uppercase pb-2">До следующего бонуса осталось: <br/>
<h5><i class="far fa-clock"></i> <b><?=sprintf("%02d <small>час</small> %02d <small>мин</small> %02d <small>сек</small>", $hh, $mm, $ss);?></b></h5>
</center>
<?php
	}
?>

<h5 class="text-center">Последние 20 бонусов</h5>
<table class="table table-bordered text-center">  
<thead>
	<th>ID</th>
	<th>Пользователь</th>
	<th>Скорость (руб/час)</th>
	<th>Дата</th>
</thead>
<?php
$bnum = $db->query("SELECT * FROM `db_bonus4` WHERE `id` > 0")->numRows();
if($bnum >= 1) {
$bon = $db->query("SELECT * FROM `db_bonus4` ORDER BY `id` DESC LIMIT 20")->fetchAll();
foreach ($bon as $b) {
?>
<tr>
    	<td><?=$b['id']; ?></td>
    	<td><?=$b['login']; ?></td>
    	<td><?=$b['sum']; ?></td>
	<td><?=date("d.m.Y в H:i:s",$b['add']); ?></td>
</tr>
<?php
	}
}
else {
	echo '<tr><td colspan="4">Список бонусов пуст</td></tr>';
}
?>
</table>