<? if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}

$opt['title'] = 'Сбор прибыли';

$db->query("SELECT * FROM db_conf WHERE id = '1' LIMIT 1");
$cnf = $db->fetchArray();

$time = time();
?>
<div class="alert bg-light text-center">
На этой странице необходимо собирать выручку, которую принес Ваш авиапарк.<br>
Полученный доход можно обменять на счет покупки или вывести на свой электронный кошелек.<br>
<span class="text-uppercase">Доход распределяется на счет для вывода <b>80%</b> и на счет покупок <b>20%</b>!</span>
</div>

<?PHP

# Ищем покупки
$update_speed = $db->query("SELECT * FROM db_store WHERE uid = '$uid' AND status = 1 ORDER BY end DESC")->fetchAll();
foreach($update_speed as $us) {

	# Если срок прошел
	if ($us['end'] < $time) {

		# Убавляем скорость
		$speed_down = $us['speed'];
		$db->query("UPDATE db_users SET speed = speed - '$speed_down' WHERE id = '$uid'");

		# Меняем статус на 0
		$pers_id = $us['id'];
		$db->query("UPDATE db_store SET status = '0' WHERE id = '$pers_id'");
	}
}



$db->Query("SELECT speed, last, id FROM db_users WHERE id = '$uid'");
$pers = $db->FetchArray();

# Считаем выручку
$profit = $func->SumCalc($pers['speed'], 1, $pers['last']);

if(isset($_POST['sbor'])){

	# Ограничиваем сбор
	if($pers['last'] < ($time-600)){
		if($profit > $cnf['min_s']){

		# Распределяем и отдаем выручку пользователю
		$money_add = $profit / $cnf['coint'];
		$money_b = ( (100 - $cnf['p_sell']) / 100) * $money_add;
		$money_p = ( ($cnf['p_sell']) / 100) * $money_add;

		$db->Query("UPDATE db_users SET money_p = money_p + '$money_p', money_b = money_b + '$money_b', last = '$time' WHERE id = '$uid'");
		echo '<div class="alert bg-success text-white">Вы собрали выручку и получили<br/> <b>На покупки: '.$money_b.' руб. <br/>На вывод: '.$money_p.' руб.</b></div>';
 		} else echo '<div class="alert bg-danger text-white">Минимальная сумма для сбора '.$cnf['min_s'].' руб.</div>';
 	} else echo '<div class="alert bg-danger text-white">Вы уже собирали прибыль за последние 10 минут!</div>';
}
?>

<div class="row">
<div class="col-lg-6">
<center class="p-2">
<center><img src="/img/promo.png" style="max-width: 75%;" alt="miner"></center>
	<div><h3><span style="font-weight: 400 !important;">
  ДОХОД:</span> <b id="mining_run"><?=sprintf("%.6f",$profit);?></b> <small>руб.</small></h3> 
	</div>

	<script>
(function () {
	var writeTo = document.getElementById("mining_run");
	var sec = <?=sprintf("%.6f",$profit);?>;
	var a = setInterval(function () {
		sec = sec + <?=$pers['speed'];?>/36000;
		writeTo.innerHTML = sec.toFixed(6);
	}, 100)
})();
</script>
	<hr class="my-1">
<form action="" method="post" class="m-0">
	<input type="hidden" name="sbor" value="<?=$pers['id']?>">
	<input type="submit" class="btn btn-danger m-2" style="font-weight: bold;" value="СОБРАТЬ ПРИБЫЛЬ">
</form>
</center>
</div>
<div class="col-lg-6">

<div class="card p-2">
<h4 class="m-0 text-center ">ВАША ДОХОДНОСТЬ</h4>

<div class="list-group m-2 mb-0">

<div class="list-group-item p-1 pl-2 pr-2">Доход в час:
<span class="float-right"><b><?=round($pers['speed'],4);?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1 pl-2 pr-2">Доход в день:
<span class="float-right"><b><?=round($pers['speed']*24,2);?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1 pl-2 pr-2">Доход в неделю:
<span class="float-right"><b><?=round($pers['speed']*24*7,2);?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1 pl-2 pr-2">Доход в месяц:
<span class="float-right"><b><?=round($pers['speed']*24*30,2);?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

</div>


</div>
</div>

</div>

<hr>


<?php 
$db->Query("SELECT * FROM db_store WHERE uid = '$uid' ORDER BY id ASC");
	if($db->NumRows() > 0){
?>
<div class="row m-0">
<?php
$pers = $db->query("SELECT * FROM db_store WHERE uid = '$uid' ORDER BY end DESC")->fetchAll();
  	foreach($pers as $pers){

# Таймер
$dt=$pers['end']-time();
$dd=(int)($dt/86400);
$hh=(int)(($dt-$dd*86400)/3600);
$mm=(int)(($dt-$dd*86400-$hh*3600)/60);
$ss=(int)($dt-$dd*86400-$hh*3600-$mm*60);
?>
	<div class="col-md-3 col-sm-4 text-center p-1">
	<div class="card mb-2">
	<h6 class="card-title mb-0"><b><?=$pers['title']; ?></b></h6>
	<hr class="my-1">
	<div class="card-body p-2"><img src="/img/items/<?=$pers['tarif']; ?>.png" style="max-width: 50%;">

<small>
	<p class="mb-0">куплен был:</p>
	<h5 class="p-0 mb-0"><?=date("d.m.Y в H:i",$pers['add']);?></h5><?
# Скрыть
$endlife2 = $pers['end'];
if(time() <= $endlife2)
{
 ?><hr class="my-1">
	<p class="mb-0">осталось: <b class="badge badge-warning"><?=sprintf("%01dд %02d:%02d:%02d", $dd, $hh, $mm, $ss);?></b></p>
	
<? } else echo '<div class="alert alert-danger mt-2 mb-0">Завершен</div>'; ?>
</small>

	</div>
  	</div>
	</div>
	<?PHP
	}
?>
</div>  

<?php
	} else echo '<div class="alert alert-danger text-center">У Вас нет покупок, купите их!</div>';
?>
