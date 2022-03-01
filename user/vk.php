<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Бонусы за подписку';

# Бонус выдача
$dep = round($user['sum_in']);

# Уровни
if($dep <= 49) {$day = 1000;}
elseif ($dep >= 50 and $dep < 249) {$day = rand(1000,  1000);}
elseif ($dep >= 250 and $dep < 999) {$day = rand(1000, 1000);}
elseif ($dep >= 1000 and $dep < 4999) {$day = rand(1000, 1000);}
elseif ($dep >= 5000) {$day = 1000;}

# Настройки бонусов
$bonus_min = $day;
$bonus_max = $day;

?>

<div class="alert bg-light text-center">
Бонус за подписку Вы можете получить став нашим подписчиком в ВКонтакте в группе проекта, а так же подписавшись на наш канал в Телеграмм. Бонус составляет <font color="red"><b>2 руб.</b></font> за каждую подписку и выдается единоразово.<br/>

</div>
<br><br>
<div class="row">
<div class="col-lg-6">
<div class="card">
<?PHP
$ddel = time() + 60*60*240000000000000000000000;
$dadd = time();
$hide = false;

$true = $db->query("SELECT * FROM `db_bonus5` WHERE `uid` = '$uid' AND `del` > '$dadd'")->numRows();
if($true == 0){

# Выдача бонуса
if(isset($_POST["bonus"])){
	$random = rand($bonus_min, rand($bonus_min, $bonus_max) );
	$sum = round($random/500,2);
	# Зачилсяем бонус
	$db->query("UPDATE db_users SET `money_b` = `money_b` + '$sum' WHERE `id` = '$uid'");
	# Вносим запись в список бонусов
	$db->query('INSERT INTO db_bonus5 (`login`, `uid`, `sum`, `add`, `del`) VALUES (?,?,?,?,?)', array($login, $uid, $sum, $dadd, $ddel));
	# Случайная очистка устаревших записей
	$db->query("DELETE FROM db_bonus5 WHERE `del` < '$dadd'");
	echo '<script> swal("Успех!", "На Ваш баланс для покупок зачислен бонус!", "success"); </script>';
	$hide = true;
}

# Скрыть кнопку
if(!$hide){
?>

 <center>
<b class="text-uppercase">Бонус ВК</b><br/>
<b>Подпишитесь на группу ВК и нажмите "Проверить"</b>
<div id="hidden_link" onclick="document.all.hidden_link1.style.display='block';" style="width: 468px;display:yes">

<form action="https://vk.com/topbest.site" method="post" target="_blank">
<input type="submit" value="Подписаться" class="btn btn-lg btn-success mt-1">
</form>

<div id="hidden_link1" onclick="document.all.hidden_link2.style.display='block';" style="display:none">

<form action="" method="post">
<input type="submit" name="bonus" value="Проверить" class="btn btn-lg btn-success mt-1" style=" box-shadow: 0px 4px 16px 8px rgba(25, 25, 25, 0.2);">
</form>
</div>
</center>
<?PHP 
	}
}
else {
	$udata = $db->query("SELECT * FROM db_bonus5 WHERE uid = '$uid'")->fetchArray();

	# Таймер
	$dt=$udata['del']-time();
	$dd=(int)($dt/86400);
	$hh=(int)(($dt-$dd*86400)/3600);
	$mm=(int)(($dt-$dd*86400-$hh*3600)/60);
	$ss=(int)($dt-$dd*86400-$hh*3600-$mm*60);
?>
<center class="alert alert-success border-success text-uppercase pb-2">
<h5><i class="fa fa-vk"></i> <b>Вы получили бонус ВК!</b></h5>
</center>
<?php
	}
?>

</div>
</div>

<div class="col-lg-6">
 <div class="card">   
<?PHP
$ddel = time() + 60*60*240000000000000000000000;
$dadd = time();
$hide = false;

$true = $db->query("SELECT * FROM `db_bonus6` WHERE `uid` = '$uid' AND `del` > '$dadd'")->numRows();
if($true == 0){

# Выдача бонуса
if(isset($_POST["bonus1"])){
	$random = rand($bonus_min, rand($bonus_min, $bonus_max) );
	$sum = round($random/500,2);
	# Зачилсяем бонус
	$db->query("UPDATE db_users SET `money_b` = `money_b` + '$sum' WHERE `id` = '$uid'");
	# Вносим запись в список бонусов
	$db->query('INSERT INTO db_bonus6 (`login`, `uid`, `sum`, `add`, `del`) VALUES (?,?,?,?,?)', array($login, $uid, $sum, $dadd, $ddel));
	# Случайная очистка устаревших записей
	$db->query("DELETE FROM db_bonus6 WHERE `del` < '$dadd'");
	echo '<script> swal("Успех!", "На Ваш баланс для покупок зачислен бонус!", "success"); </script>';
	$hide = true;
}

# Скрыть кнопку
if(!$hide){
?>
<center >
<b class="text-uppercase">Бонус в ТГ</b><br/>
<b>Подпишитесь на канал и нажмите "Проверить"</b>
<div id="hidden_link3" onclick="document.all.hidden_link4.style.display='block';" style="width: 468px;display:yes">

<form action="https://t.me/TopBestMoney" method="post" target="_blank">
<input type="submit" value="Подписаться" class="btn btn-lg btn-success mt-1">
</form>

</div>
<div id="hidden_link4" onclick="document.all.hidden_link5.style.display='block';" style="display:none">



<form action="" method="post">
<input type="submit" name="bonus1" value="Проверить" class="btn btn-lg btn-success mt-1" style=" box-shadow: 0px 4px 16px 8px rgba(25, 25, 25, 0.2);">
</form>
</div>
</center>
<?PHP 
	}
}
else {
	$udata = $db->query("SELECT * FROM db_bonus6 WHERE uid = '$uid'")->fetchArray();

	# Таймер
	$dt=$udata['del']-time();
	$dd=(int)($dt/86400);
	$hh=(int)(($dt-$dd*86400)/3600);
	$mm=(int)(($dt-$dd*86400-$hh*3600)/60);
	$ss=(int)($dt-$dd*86400-$hh*3600-$mm*60);
?>
<center class="alert alert-success border-success text-uppercase pb-2">
<h5><i class="fa fa-telegram"></i> <b>Вы получили бонус ТГ!</b></h5>
</center>
<?php
	}
?>

</div>
</div>
</div>
