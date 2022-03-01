<? if(!defined('FastCore')){ exit('Oops!');}
$opt['title'] = 'Счастливый билет';
?>
 <div class="alert bg-light text-center">
Испытай свою удачу, пополняй игровой баланс и получай счастливый билет!<br/>
За каждое пополнение на сумму <b>100 руб.</b> Вам начисляется <b>1 билет</b>, которые можно испытать бесплатно!<hr class="my-1">
<b>ВЫ МОЖЕТЕ ПОЛУЧИТЬ С ОДНОГО СЧАСТЛИВОГО БИЛЕТА: <b class="text-danger">1, 2, 3, 5, 10, 25, 50 РУБЛЕЙ</b> НА ВЫВОД!</b>
</div>



<div class="card card-body pb-0">

<center>
<h4>У ВАС ИМЕЕТСЯ <b class="text-success"><?=$user['freebet'];?></b> ДЕНЕЖНЫХ БИЛЕТОВ!</h4>
</center>

<center>
<div class="col-md-6">
<center class="card card-body bg-light text-uppercase" style="min-height: 100px;">
<?php

# Начало
if(isset($_POST['freebet'])){	

	# Проверяем билеты
	if(1 <= $user['freebet']) {

		# Кол-во и сумма призов
		$gift_cnt = array(1 => "1", 2 => "10", 3 => "25", 4 => "2", 5 => "50", 6 => "3", 7 => "5");

		# Настройка шанса
		$rand = rand(1, 100);
		if($rand >= 1 && $rand <= 43) {$i= 1;} // 43%
		elseif($rand >= 44 && $rand <= 46) {$i= 2;} // 3%
		elseif($rand >= 47 && $rand <= 48) {$i= 3;}  // 2%
		elseif($rand >= 49 && $rand <= 81) {$i= 4;} // 33%
		elseif($rand >= 82 && $rand <= 82) {$i= 5;} // 1%
		elseif($rand >= 83 && $rand <= 90) {$i= 6;} // 8%
		elseif($rand >= 91 && $rand <= 100) {$i= 7;} // 10%

		$random_sum = $gift_cnt[$i];
		$money_bill = $random_sum; // рандомная сумма
		$freebet = 1; // списываем 1 билет
		$time = time();
		$login = $user['login'];

		# Начисляем выигрыш и списываем билет
		$db->query("UPDATE db_users SET freebet = freebet - $freebet, money_p = money_p + $money_bill WHERE id = '$uid'");
		# Вносим в статистику
		$db->query("INSERT INTO db_loto_wins (uid, login, num_bill, sum, `add`) VALUES ('$uid', '$login', '$rand', '$money_bill', '$time')");

		echo '<h3 class="text-success m-0 p-0"><b>Выигрыш: '.$money_bill.' руб.</b><br/> <small>Поздравляем!</small></h3>';
	}	else echo '<h3 class="text-danger m-0 p-0"><b>У вас нет билетов!</b> <br/><small>Пополните баланс от 100 руб!</small></h3>';	
} else {
	echo '<h3 class="m-0 p-0 text-secondary"><b>Испытай свою удачу!</b><br/><small>Нажмите на кнопку!</small></h3>';
}
?></center>

<form action="" method="post" class="mb-2 text-center">
	<input type="hidden" name="freebet" />
	<button class="btn btn-lg btn-success" type="submit"><b>ИСПЫТАТЬ УДАЧУ</b></button>
</form>

</div>
</center>
</div>



<div class="row">

<div class="col-lg-4">

<h5 class="text-center">Ваши игры:</h5>
<table class="table table-sm table-bordered text-center">  
<thead>
	<th>ID</th>
	<th>Выигрыш</th>
	<th>Дата</th>
</thead>
<?php
$user_wins = $db->query("SELECT * FROM `db_loto_wins` WHERE uid = '$uid'  ORDER BY `id` DESC LIMIT 10")->fetchAll();
foreach ($user_wins as $b) {
?>
<tr>
    	<td><?=$b['id']; ?></td>
    	<td><span class="badge badge-success" style="font-size: 95%;"><?=$b['sum']; ?> руб.</span></td>
	<td><?=date("d.m.y в H:i",$b['add']); ?></td>
</tr>
<?php
	}
?>
</table>
</div>

<div class="col-lg-8">

<h5 class="text-center">Последние 10 счастливщиков:</h5>
<table class="table table-sm table-bordered text-center">  
<thead>
	<th>ID</th>
	<th>Пользователь</th>
	<th>Выигрыш</th>
	<th>Дата</th>
</thead>
<?php
$users_wins = $db->query("SELECT * FROM `db_loto_wins` ORDER BY `id` DESC LIMIT 10")->fetchAll();
foreach ($users_wins as $b) {
?>
<tr>
    	<td><?=$b['id']; ?></td>
    	<td><?=$b['login']; ?></td>
    	<td><span class="badge badge-success" style="font-size: 95%;"><?=$b['sum']; ?> руб.</span></td>
	<td><?=date("d.m.y в H:i",$b['add']); ?></td>
</tr>
<?php
	}
?>
</table>
</div>


</div>


