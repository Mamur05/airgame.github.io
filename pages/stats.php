<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
# Заголовки
$opt = array(
'title' => 'Статистика проекта',
'keywords' => 'статистика, пользователи, топ, лидеры, старт, проект',
'description' => 'Статистика нашего проекта, Вы можете посмотреть лидеров и активность игроков.'
);

# Количество 24 часа
$times = time() - 60*60*24;
$users_rows = $db->query("SELECT reg FROM `db_users` WHERE `reg` > '$times'")->numRows();
$users24 = $users_rows;

# Статистика
$stats = $db->query("SELECT * FROM db_stats WHERE id = '1'")->fetchArray();
?>

<div class="wrapper" style="background: rgba(35,45,55,0.3) !important;margin-top:-1px;">

<br/>
<div class="row m-0">

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block" title="Новых за 24 часа +<?=$users24;?> чел.">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st1.png"></div>
			<h3><b><?=$stats['users'];?> <small>чел.</small></b></h3>
		</center>
		</div>
		<div class="stat-title">Пользователей</div>
	</div>
</div>

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st3.png"></div>
			<h3><b><?=round($stats['inserts'],2);?> <small>руб.</small></b></h3>
		</center>
		</div>
		<div class="stat-title">Пополнено</div>
	</div>
</div>

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st4.png"></div>
			<h3><b><?=round($stats['payments'],2);?> <small>руб.</small></b></h3>
		</center>
		</div>
		<div class="stat-title">Выплачено</div>
	</div>
</div>

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st2.png"></div>
			<h3><b><?=intval(((time() - $config->start_time) / 86400 ) +1); ?></b></h3>
		</center>
		</div>
		<div class="stat-title">Работает дней</div>
	</div>
</div>

</div>


<hr>

<div class="row table-st">
<div class="col-md-6">
<div class="card">
<h5 class="card-header">Последние 10 пополнений:</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Сумма</td>
		<td>Время</td>
	</thead>
<?php
$inserts = $db->query('SELECT * FROM db_insert WHERE status = 1  ORDER BY id DESC LIMIT 10')->fetchAll();
foreach ($inserts as $inserts) {
		?>
		<tr>
			<td><i class="fa fa-user"></i> <?=$inserts['login']; ?></td>
			<td><?= sprintf("%.2f",$inserts['sum']); ?> руб.</td>
			<td><?=date("d/m/Y в H:i",$inserts['add']); ?> <i class="fa fa-clock-io"></i></td>
  		</tr>
		<?php
	}
  ?>
</table>
</div>
</div>

<div class="col-md-6">
<div class="card">
<h5 class="card-header">Последние 10 выплат:</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Сумма</td>
		<td>Время</td>
	</thead>
<?php
$payout = $db->query('SELECT * FROM db_payout WHERE status = 3  ORDER BY id DESC LIMIT 10')->fetchAll();
foreach ($payout as $payout) {
		?>
		<tr>
			<td><i class="fa fa-user"></i> <?=$payout['login']; ?></td>
			<td><?= sprintf("%.2f",$payout['sum']); ?> руб.</td>
			<td><?=date("d/m/Y в H:i",$payout['add']); ?> <i class="fa fa-clock-io"></i></td>
  		</tr>
		<?php
	}
  ?>
</table>
</div>
</div>

</div>
</div>




<center><h3 class="text-center text-uppercase wrapper-title shadow-sm"><b>ТОП-10 АКТИВНЫХ УЧАСТНИКОВ ПРОЕКТА</b></h3></center>

<div class="wrapper mt-2" style="background: rgba(35,45,55,0.3) !important;margin-top:-1px;">
<div class="row table-st m-0">

<div class="col-md-4 p-2">
<div class="card">
<h5 class="card-header">топ инвесторов</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Сумма</td>
	</thead>
<?php
$ins = $db->query('SELECT * FROM db_users WHERE sum_in  ORDER BY sum_in DESC LIMIT 10')->fetchAll();
foreach ($ins as $ins) {
?>
	<tr>
		<td><i class="fa fa-user"></i> <?=$ins['login']; ?></td>
		<td><?= sprintf("%.2f",$ins['sum_in']); ?> руб.</td>
  	</tr>
	<?php
}
?>
</table>
</div>
</div>


<div class="col-md-4 p-2">
<div class="card">
<h5 class="card-header">по доходу в час</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Доход в час</td>
	</thead>
<?php

$xsto = 1;
$speed = $db->query('SELECT * FROM db_users WHERE speed+'.$xsto.' ORDER BY speed DESC LIMIT 10')->fetchAll();

foreach ($speed as $speed) {
?>
	<tr>
		<td><i class="fa fa-user"></i> <?=$speed['login']; ?></td>
		<td><?=$speed['speed']; ?> руб.</td>
  	</tr>
	<?php
}
?>
</table>
</div>
</div>

<div class="col-md-4 p-2">
<div class="card">
<h5 class="card-header">по просмотру ссылок</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Просмотры</td>
	</thead>

<?php
$views= $db->query('SELECT * FROM db_users WHERE views  ORDER BY views DESC LIMIT 10')->fetchAll();
foreach ($views as $v) {
?>
	<tr>
		<td><i class="fa fa-user"></i> <?=$v['login']; ?></td>
		<td><?=$v['views']; ?></td>
  	</tr>
	<?php
}
?>
</table>
</div>
</div>


<div class="col-md-4 p-2">
<div class="card">
<h5 class="card-header">по рефералам</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Кол-во</td>
	</thead>
<?php
$refs = $db->query('SELECT * FROM db_users WHERE refs  ORDER BY refs DESC LIMIT 10')->fetchAll();
foreach ($refs as $refs) {
?>
	<tr>
		<td><i class="fa fa-user"></i> <?=$refs['login']; ?></td>
		<td><?=$refs['refs']; ?> чел.</td>
  	</tr>
	<?php
}
?>
</table>
</div>
</div>

<div class="col-md-4 p-2">
<div class="card">
<h5 class="card-header">по реф-доходу</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Сумма</td>
	</thead>
<?php
$refi = $db->query('SELECT * FROM db_users WHERE income  ORDER BY income DESC LIMIT 10')->fetchAll();
foreach ($refi as $rf) {
?>
	<tr>
		<td><i class="fa fa-user"></i> <?=$rf['login']; ?></td>
		<td><?=$rf['income']; ?> руб.</td>
  	</tr>
	<?php
}
?>
</table>
</div>
</div>

<div class="col-md-4 p-2">
<div class="card">
<h5 class="card-header">по выплатам</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Сумма</td>
	</thead>
<?php
$out = $db->query('SELECT * FROM db_users WHERE sum_out  ORDER BY sum_out DESC LIMIT 10')->fetchAll();
foreach ($out as $out) {
?>
	<tr>
		<td><i class="fa fa-user"></i> <?=$out['login']; ?></td>
		<td><?= sprintf("%.2f",$out['sum_out']); ?> руб.</td>
  	</tr>
	<?php
}
?>
</table>
</div>
</div>

</div>

</div>