<? if(!defined('FastCore')){ exit('Oops!');}
$opt['title'] = 'Джекпот';

$jpot = $db->query("SELECT * FROM db_jackpot WHERE id = 1 LIMIT 1")->fetchArray();
$jack = $jpot['jackpot'];
?>
 <div class="alert bg-light text-center">
Покажи свой характер, нажми на фартовую кнопку и забирай крупный кэш!<br/>
Осторожно фартовая кнопка может выдать ДЖЕКПОТ и это всего по ставке 5 руб!<hr class="my-1">
<b>ВЫПЛАТЫ: <b class="text-danger">0 | 1 | 2.5 | 5 | 7.5 | 10 | 15 | 20 | 25 | 50 | 100 РУБЛЕЙ +ДЖЕКПОТ</b> НА ПОКУПКИ!</b><br/>
<small>Джекпот накопительный. После розыгрыша отчет начинается со 100 рублей и растет с каждой совершенной ставки.</small>
</div>



<div class="card card-body pb-0" style="">

<center>
<h4>ДЖЕКПОТ СОСТАВЛЯЕТ: <b class="text-success"><?=$jack;?></b> РУБЛЕЙ!</h4>
</center>

<center>
<div class="col-md-6">
<center class="card card-body bg-light text-uppercase" style="min-height: 60px;">
<?php


# Начало
if(isset($_POST['freebet'])){	

	# Проверяем билеты
	if(5 <= $user['money_b']) {


		# Настройка шанса
		$rtp = array(1 => "1", 2 => "2.5", 3 => "15", 4 => "25", 5 => "50", 6 => "10", 7 => "$jack", 8 => "20", 9 => "7.5", 10 => "5", 11 => "0"); // Выплаты

		$rand = rand(1, 200); // Бог рандома
		if($rand >= 1 && $rand <= 40) {$i= 1;} // 20%
		elseif($rand >= 41 && $rand <= 65) {$i= 2;} // 12.5%
		elseif($rand >= 66 && $rand <= 76) {$i= 3;}  // 5%
		elseif($rand >= 77 && $rand <= 80) {$i= 4;} // 4%
		elseif($rand >= 81 && $rand <= 81) {$i= 5;} // 1%
		elseif($rand >= 82 && $rand <= 87) {$i= 6;} // 2%
		elseif($rand >= 88 && $rand <= 88) {$i= 7;} // 1%
		elseif($rand >= 89 && $rand <= 90) {$i= 8;} // 0.5%
		elseif($rand >= 91 && $rand <= 100) {$i= 9;} // 5%
		elseif($rand >= 101 && $rand <= 150) {$i= 10;} // 25%
		elseif($rand >= 151 && $rand <= 200) {$i= 11;} // 25%

		$random_sum = $rtp[$i];
		$win = $random_sum; // выигрыш
		$bet = 5; // списываем 5 руб.
		$jackplus = 1; // +1 руб джеку
		$time = time();
		$login = $user['login'];

		if ($rand == 88) {
		$db->query("UPDATE db_jackpot SET jackpot = jackpot - $win,  jackpot = jackpot + 100 WHERE id = 1"); // выдает джекпот и начинает новый отчет
		$jwins = 1;
		} else {
		$db->query("UPDATE db_jackpot SET jackpot = jackpot + $jackplus WHERE id = 1"); // плюсует джекпот
		$jwins = 0; 
		}

		# Пишет статистику
		$db->query("UPDATE db_jackpot SET wins = wins + $win, `count` = `count` + 1  WHERE id = 1");

		# Начисляем выигрыш и списываем билет
		$db->query("UPDATE db_users SET money_b = money_b - $bet, money_b = money_b + $win WHERE id = '$uid'");
		# Вносим в статистику
		$db->query("INSERT INTO db_jackpot_wins (uid, login, sum, jack, `add`) VALUES ('$uid', '$login', '$win', '$jwins', '$time')");

		echo '<h3 class="text-success m-0 p-0 wow fadeIn"><b>Выигрыш: '.$win.' руб.</b></h3>';
	}	else echo '<h3 class="text-danger m-0 p-0"><b>Недостаточно средств!</b></h3>';	
} else {
	echo '<h3 class="m-0 p-0 text-secondary"><b>Нажми на кнопку!</b></h3>';
}
?></center>

<form action="" method="post" class="mb-2 text-center">
	<input type="hidden" name="freebet" />
	<button class="btn btn-lg btn-success" type="submit"><b>СТАВКА 5 РУБ.</b></button>
</form>

</div>
</center>
</div>



<div class="row">

<div class="col-lg-2">

</div>
<div class="col-lg-8">

<h5 class="text-center">История ваших игр:</h5>
<table class="table table-sm table-bordered text-center">  
<thead>
	<th>ID</th>
	<th>Выигрыш</th>
	<th>Дата</th>
</thead>
<?php
$user_wins = $db->query("SELECT * FROM `db_jackpot_wins` WHERE uid = '$uid'  ORDER BY `id` DESC LIMIT 10")->fetchAll();
foreach ($user_wins as $b) {
?>
<tr>
    	<td><?=$b['id']; ?></td>
    	<td><span class="badge badge-success" style="font-size: 95%;"><?=$b['sum']; ?> руб.</span></td>
	<td><?=date("d-m-Y в H:i:s",$b['add']); ?></td>
</tr>
<?php
	}
?>
</table>
</div>



</div>


<center><br/>
<h4>ПОЛЬЗОВАТЕЛИ ВЫИГРЫВАЮТ:</h4>
<div class="row m-0">

<?php
$users_wins = $db->query("SELECT * FROM `db_jackpot_wins` WHERE sum > 5  ORDER BY `id` DESC LIMIT 6")->fetchAll();
foreach ($users_wins as $uw) {
?>
<div class="col-lg-2 col-md-4 p-1 text-center">
<div class="alert bg-light p-1">
	<b><i class="fa fa-user"></i> <br/><?=$uw['login']; ?></b><br/>
    	<i><span class="badge badge-warning" style="font-size: 100%;"><small>Выиграл:</small><br/>+<?=$uw['sum']; ?> руб. </span></i><br/>
	<small><?=date("d-m-Y в H:i",$uw['add']); ?></small>
</div>
</div>
<?php
	}
?>

</div>
</center>
