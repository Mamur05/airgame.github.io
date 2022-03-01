<? if(!defined('FastCore')){ exit('Oops!');}
$opt['title'] = 'Покупка самолетов';
?>
 <div class="alert bg-light text-center">
Покупайте самолеты разного уровня, и получайте доход каждый час!<br/>
Ваши самолеты будут приносить доход круглосуточно, без пересадок и выходных.<br/>
САМОЛЕТЫ РАБОТАЮТ КРУГЛОСУТОЧНО И ПРИНОСЯТ ДЕНЬГИ, ПОКА ВЫ ОТДЫХАЕТЕ!.<hr class="my-1">
<small class="text-danger"><b>ПЕРЕД ПОКУПКОЙ САМОЛЕТА, СОБЕРИТЕ ПРИБЫЛЬ! ЧТОБЫ НЕ ПОТЕРЯТЬ ДОХОД!</b></small>
</div>
<?PHP
# Покупка персонажа
if(isset($_POST['item'])){
$id = intval($_POST['item']);
	$rows = $db->query('SELECT * FROM db_tarif WHERE id = ?',array($id))->numRows();
	if ($rows) {
		$items = $db->query("SELECT * FROM db_tarif WHERE id = '$id' LIMIT 1")->fetchArray();
		# Проверяем средства пользователя
		$need_money = $items['price'];
		if($need_money <= $user['money_b']){

		$title = $items['title'];
		$speed = $items['speed'];
		$time = time();
		$end = $time+60*60*24*$items['period'];

		# Добавляем персонажа и списываем деньги
		$db->query("UPDATE db_users SET money_b = money_b - $need_money, speed = speed + $speed, last ='$time' WHERE id = '$uid'");
		$db->query("INSERT INTO db_store (uid, tarif, title, speed, level, `add`, `end`, `last` ) VALUES ('$uid', '$id', '$title', '$speed', '1', '$time', '$end', '$time')");

		echo '<div class="alert bg-success text-white text-center">Вы оплатили - '.$title.'!</div>';
		}else echo '<div class="alert bg-danger text-white text-center">Недостаточно средств для оплаты!</div>';	
	}
}
?>

<div class="nav nav-pills nav-fill text-uppercase wow bounceInUp">
<?PHP
$shop = $db->query("SELECT * FROM db_tarif")->fetchAll();

  	foreach($shop as $shop){
$month= sprintf("%.0f",($shop['speed']*100)/$shop['price']*24*30);
?>
<div class="nav-item nav-link p-2" style="font-size: 120%;">
<div class="trf-home card m-0 text-uppercase shadow">
<center>
<div class="trf-img" style="background: #23a5f5 url(/img/items/<?=$shop['img']; ?>.png) no-repeat center center;border: 0;" alt="shop">
	<span><?=$shop['img']; ?></span>
</div>
</center>
 <h4 class="card-title mb-0">
<b><?=$shop['title']; ?></b>
</h4>



<div class="list-group m-2 mb-0 text-left">

<div class="list-group-item p-1"><small>Скорость:</small> 
<span class="float-right"><b><?=$shop['speed']; ?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1"><small>Доход в день:</small> 
<span class="float-right"><b><?=$shop['speed']*24; ?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1"><small>Доход в месяц:</small> 
<span class="float-right"><b><?=$shop['speed']*24*30; ?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>
<div class="list-group-item p-1"><small>Окупаемость в месяц:</small> 
<span class="float-right"><b><?=$month; ?>%</b> </span>
</div>

<div class="list-group-item p-1"><small>Срок аренды:</small> 
<span class="float-right"><b><?=$shop['period']; ?> дней</b> </span>
</div>

</div>


<form action="" method="post" class="mb-2 text-center">
 <input type="hidden" name="item" value="<?=$shop['id'];?>" />
 <button class="btn btn-danger" type="submit">КУПИТЬ <b><?=$shop['price']; ?></b> <i class="fa fa-ruble-sign" style="font-size: 90%;"></i></button>
 </form>
 </div>
</div>
	<?PHP
	}
?> 
</div>