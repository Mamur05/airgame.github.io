<?php if(!defined('FastCore')){ exit('Oops!'); }

/*
* Модуль ежедневного конкурса инвесторов с 5% банком от суммы пополнений за текущий день, банк распределяется на 5 участников.
* Powered by Jumast - jumast@ya.ru 
* Date: v1 - 10/05/2020;
*/

# Заголовок
$opt['title'] = 'Гонка лидеров';

# Начало и конец конкурса
$c_date = date("Ymd",time());
$c_date_begin = strtotime($c_date." 00:00:00");
$c_date_end = strtotime($c_date." 23:59:59");

# Таймер розыгрыша
$now = time();
$endtime = $c_date_end - $now;
$hours = floor($endtime/3600);
floor($minutes =($endtime/3600 - $hours)*60);
$seconds = ceil(($minutes - floor($minutes))*60);
$min=ceil($minutes)-1;

# Определение платежей за текущий день
$sum_in = $db->query('SELECT SUM(sum) FROM db_insert WHERE `add` >= '.$c_date_begin.' AND `add` <= '.$c_date_end.' AND status = 1')->fetchAll();
foreach ($sum_in as $all) {
	$jackpot = round($all['SUM(sum)']/20,2); // банк 5% от пополнений за текущий день
}


?>
<div class="row">

<div class="col-lg-3 col-md-0" style="background: url('/img/start.png') no-repeat center center;background-size: 160px;">
</div>

<div class="col-lg-9 col-md-12">

<div class="alert alert-success">
Стань лидером этой гонки среди инвесторов, и выиграй главный приз за текущий день!
Банк составляет <font style="color:#e22;"><b>5%</b></font> который формируется от суммы всех пополнений в течение дня, 5-победителей делят весь банк, чем больше пополняешь тем выше место.<br/>
<b>Призовые места:<br/><i>
<span class="badge badge-warning" style="font-size: 100%;">1-МЕСТО: 50%</span>
<span class="badge badge-danger" style="font-size: 100%;">2-МЕСТО: 20%</span>
<span class="badge badge-info" style="font-size: 100%;">3-МЕСТО: 15%</span>
<span class="badge badge-success" style="font-size: 100%;">4-МЕСТО: 10%</span>
<span class="badge badge-secondary" style="font-size: 100%;">5-МЕСТО: 5%</span></i>
</b>
</div>

<div class="alert bg-warning">
 <b style="font-size: 32px;">ТЕКУЩИЙ БАНК: <font style="color:#f22;font-weight: bold;"><?=$jackpot; ?></font> РУБ.</b><hr class="my-1">
 <span>РОЗЫГРЫШ СОСТОИТСЯ ЧЕРЕЗ: <b><span id="my_timer"><?=$hours;?>:<?=$min;?>:<?=$seconds;?></span></b> ч.</span></div>

</div>

<div class="col-md-12">


<div class="p-3">
<center><h5>Участники сегодняшнего розыгрыша</h5></center>
<table class='table table-bordered table-sm table-striped text-center'>
  <thead>
	<th>#</th>
	<th>Пользователь</th>
	<th>Пополнение</th>
	<th>Выигрыш</th>
  </thead>

<?php
# Список лидеров на сегодня
$sum_in = $db->query('SELECT login, SUM(sum) AS `sum` FROM db_insert WHERE `add` >= '.$c_date_begin.' AND `add` <= '.$c_date_end.' AND status = 1 GROUP BY login ORDER BY `sum` DESC LIMIT 10')->fetchAll();
$rub = " руб.";
if($sum_in == true) {
$i=1;
foreach ($sum_in as $bon) {
?>
<tr>
	<td><b><?=$i; ?></b></td>
	<td><b><?=$bon["login"]; ?></b></td>
	<td><b><?=round($bon["sum"],2); ?> руб.</b></td>
	<td><span class="badge badge-success" style="font-size: 100%;"><i class="fa fa-star text-warning"></i> <?php if ($i==1) echo $jackpot*0.5. $rub; else if ($i==2) echo $jackpot*0.2. $rub; else if ($i==3) echo $jackpot*0.15. $rub; else if ($i==4) echo $jackpot*0.1. $rub; else if ($i==5) echo $jackpot*0.05. $rub; else echo "0";?></span></td>
</tr>
<?php
	$i++;
		}
	} else echo '<tr><td align="center" colspan="4">Еще никто не пополнял сегодня, участников нет</td></tr>'
?>

</table>

</div>
</div>

<div class="col-md-12 p-1">
<center>
	<h4>Результаты предыдущих розыгрышей</h4>
</center>
<div class="row m-0">
<?php
# Прошлые конкурсы
$end_contest = $db->query('SELECT * FROM db_liders WHERE id ORDER BY id DESC LIMIT 6')->fetchAll();
foreach ($end_contest as $li) {
?>
<div class="col-lg-4 col-md-6 p-2">
<div class="list-group mb-1">

<div class="list-group-item p-1 bg-warning"><b>Розыгрыш #<?=$li['id'];?></b></div>

<div class="list-group-item p-1">Дата проведения:
<span class="float-right"><b><?=date("d/m/Y",$li['date_add']-24*60*60);?></b></span>
</div>

<div class="list-group-item p-1">Общий банк:
<span class="float-right"><b><?=$li['bank'];?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1">1-место:
<span class="float-right"><b><?=$li['u1'];?> (<?=$li['1m'];?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i>)</span>
</div>

<div class="list-group-item p-1">2-место:
<span class="float-right"><b><?=$li['u2'];?> (<?=$li['2m'];?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i>)</span>
</div>

<div class="list-group-item p-1">3-место:
<span class="float-right"><b><?=$li['u3'];?> (<?=$li['3m'];?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i>)</span>
</div>

<div class="list-group-item p-1">4-место:
<span class="float-right"><b><?=$li['u4'];?> (<?=$li['4m'];?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i>)</span>
</div>

<div class="list-group-item p-1">5-место:
<span class="float-right"><b><?=$li['u5'];?> (<?=$li['5m'];?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i>)</span>
</div>

</div>
</div>

<?php 
}
?>
</div>

</div>
</div>