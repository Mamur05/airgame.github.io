<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Бонус каждые 12 часов';

# Бонус выдача
$dep = round($user['sum_in']);

# Уровни
//if($dep <= 249) {$day =10;}
//elseif ($dep >= 250 and $dep < 999) {$day = rand(10,  50);}
//elseif ($dep >= 1000) {$day = 50;}

# Настройки бонусов
$bonus_min = 1;
$bonus_max = 10;

?>
<div class="alert bg-light text-center">
Бонус выдается каждые 12 часов, на покупку.<br/>
Сумма бонуса генерируется случайно от <font class="text-danger"><b>0.01</b></font> до <font class="text-danger"><b>0.10</b></font> руб.<br/>
Бонус доступен только тем кто пополнил баланс от 11 руб.
</div>

<?PHP
$ddel = time() + 60*60*12;
$dadd = time();
$hide = false;

$true = $db->query("SELECT * FROM `db_bonus2` WHERE `uid` = '$uid' AND `del` > '$dadd'")->numRows();
if($true == 0){

# Выдача бонуса
if(isset($_POST["bonus"])){

	$sumlimit = 10; // заглушка
	if ($sumlimit < $user['sum_in']){

	$random = rand($bonus_min, rand($bonus_min, $bonus_max) );
	$sum = round($random/100,2);
	# Зачилсяем бонус
	$db->query("UPDATE db_users SET `money_b` = `money_b` + '$sum' WHERE `id` = '$uid'");
	# Вносим запись в список бонусов
	$db->query('INSERT INTO db_bonus2 (`login`, `uid`, `sum`, `add`, `del`) VALUES (?,?,?,?,?)', array($login, $uid, $sum, $dadd, $ddel));
	# Случайная очистка устаревших записей
	$db->query("DELETE FROM db_bonus2 WHERE `del` < '$dadd'");
	echo '<div class="alert alert-success">На Ваш счет для покупок зачислен бонус.</div>';
	$hide = true;

	} else echo '<div class="alert alert-danger">Бонус доступен только тем кто пополнял от 11 РУБ.</div>'; 
}

# Скрыть кнопку
if(!$hide){
?>
<center class="mb-1">
<b class="text-uppercase">Перейдите по баннеру и нажмите получить бонус</b><br/>
<div id="hidden_link" onclick="document.all.hidden_link1.style.display='block';" style="width: 468px;display:yes">

<div id="linkslot_303334"><script src="https://linkslot.ru/bancode.php?id=303334" async></script></div>
<div id="linkslot_303335"><script src="https://linkslot.ru/bancode.php?id=303335" async></script></div>
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
	$udata = $db->query("SELECT * FROM db_bonus2 WHERE uid = '$uid'")->fetchArray();

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
	<th>Сумма</th>
	<th>Дата</th>
</thead>
<?php
$bnum = $db->query("SELECT * FROM `db_bonus2` WHERE `id` > 0")->numRows();
if($bnum >= 1) {
$bon = $db->query("SELECT * FROM `db_bonus2` ORDER BY `id` DESC LIMIT 20")->fetchAll();
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