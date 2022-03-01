<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}

include ('inc/akcii.php'); // Бонусы при пополнении

if(empty($pg->segment[2] ==='insert')) $type=1; // начало
if(!empty($pg->segment[2] ==='payeer')) $type=2; // Payeer
if(!empty($pg->segment[2] ==='freekassa')) $type=3;  // Freekassa
?>
<?php
if($type==1) { 
$opt['title'] = 'Пополнить баланс';
?>

<hr>

<div class="card pb-0">
<h5 class="card-header text-center text-uppercase">Выберите способ пополнения игрового баланса:</h5>
<div class="row m-2 ">
	<div class="col-lg-6">
	<a href="/user/insert/payeer" class="card p-5 bg-light mb-1" style="background: url(/img/pay/payeer.png) no-repeat center center;background-size: 240px;"><br/><br/><br/></a>
	</div>
	<div class="col-lg-6">
	<a href="/user/insert/freekassa" class="card p-5 bg-light mb-1" style="background: url(/img/pay/free.png) no-repeat center center;background-size: 240px;"><br/><br/><br/></a>
	</div>
</div>

</div>


<?php
} elseif($type==2) { 
?>
<?php

$opt['title'] = 'Пополнение через Payeer';

# Payeer пополнение
if(isset($_POST["sum"])){

$sum = round(floatval($_POST["sum"]),2);
$sum_x = '0';
$sys = 'payeer';

# Заносим в БД
$db->query("INSERT INTO db_insert (uid, login, sum, sum_x, sys, `add`, status) VALUES ('$uid','$login','$sum','$sum_x','$sys','".time()."','0')");

$desc = base64_encode($_SERVER["HTTP_HOST"]." - USER ".$login);
$m_shop = $config->py_shop;
$m_orderid = $db->LastInsert();
$m_amount = number_format($sum, 2, ".", "");
$m_curr = "RUB";
$m_desc = $desc;
$m_key = $config->py_secret;

$arHash = array(
 $m_shop,
 $m_orderid,
 $m_amount,
 $m_curr,
 $m_desc,
 $m_key
);
$sign = strtoupper(hash('sha256', implode(":", $arHash)));

?>
<center>
<form method="GET" action="//payeer.com/api/merchant/m.php">
	<input type="hidden" name="m_shop" value="<?=$config->py_shop; ?>">
	<input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
	<input type="hidden" name="m_amount" value="<?=number_format($sum, 2, ".", "")?>">
	<input type="hidden" name="m_curr" value="RUB">
	<input type="hidden" name="m_desc" value="<?=$desc; ?>">
	<input type="hidden" name="m_sign" value="<?=$sign; ?>">
	<input type="submit" name="m_process" value="Оплатить через Payeer" class="btn btn-lg btn-success">
</form>
</center>
<?php
return;
}
?>


<div class="row text-center text-uppercase">
<div class="col-lg-6">
<div class="card">
<h5 class="card-header">Пополнить баланс через <b>PAYEER</b></h5>
<div class="card-body">

<script type="text/javascript">
	var cf= 1;
function generateThis() {
	var sum=document.getElementById("getsum").value;
	var mn=sum*cf;
	var pro=0;

<?php
$bbb= $db->query('SELECT * FROM db_percent WHERE type = 1  ORDER BY sum_a < sum_a DESC LIMIT 7')->fetchAll();
foreach ($bbb as $inb) {
?>
        if(sum><?=$inb['sum_a']-1; ?>){ mn=sum*cf;pro=<?=$inb['sum_x']; ?>;}
<?php
	}
?>

	$("#d1").html(pro *100);
	$("#d2").html( (mn=sum*pro ).toFixed(2));	
	$("#d3").html( (sum*1).toFixed(2));	
}

</script>
<form action="" method="post">
<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-ruble-sign"></i></span></div>
	<input type="number" class="form-control" value="10" min="1" max="15000" name="sum" onkeyup="generateThis();" id="getsum"/>
</div>
<div class="card bg-light mb-2">
<div class="p-2">
Получаете: <b id="d3"></b> <small>РУБ.</small>
 <span class="badge badge-warning p-1" style="font-size: 100%"><small>Бонус:</small> <b id="d2"></b> <small>РУБ.</small> (+<b id="d1"></b>%)</span><br/>
</div>
</div>
	<input type="submit" value="Перейти к оплате" class="btn btn-lg btn-success"/>

</form>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="card">
<h5 class="card-header">Способы оплаты:</h5>
<div class="card-body">
Payeer, Яндекс.Деньги, Qiwi, Advcash, VISA, MASTERCARD, МИР, MAESTRO, BITCOIN, ETHEREUM, DASH, LITECOIN, Ripple, МТС, ТЕЛЕ2, МЕГАФОН, БИЛАЙН, Связной, Евросеть и наличные платежи Москва.<hr>
<b>Коммисия при пополнении 0%</b>
</div>
</div>
</div>

<script>
	var sum=document.getElementById("getsum").value;
	var pro=0.03;
	var mn=sum*pro;
	$("#d1").html(pro *100);
	$("#d2").html( (mn=sum*pro ).toFixed(2));	
	$("#d3").html( (sum*1).toFixed(2));		
</script>
</div>












<?php
} elseif($type==3) { ?>
<?php

$opt['title'] = 'Пополнение через FreeKassa';

# Freekassa пополнение
if(isset($_POST["sum"])){

# FK конфиг
$fk_merchant_id = $config->fk_id; // merchant_id ID мазагина в free-kassa.ru http://free-kassa.ru/merchant/cabinet/help/
$fk_merchant_key = $config->fk_key; // Секретное слово http://free-kassa.ru/merchant/cabinet/profile/tech.php

$sum = round(floatval($_POST["sum"]),2);
$sum_x = '0';
$sys = 'freekassa';

# Заносим в БД
$db->query("INSERT INTO db_insert (uid, login, sum, sum_x, sys, `add`, status) VALUES ('$uid','$login','$sum','$sum_x','$sys','".time()."','0')");

# Формируем номер платежа
$order_id = $db->LastInsert();

# Это соль
$hash = md5($fk_merchant_id.':'.$sum.':'.$fk_merchant_key.':'.$order_id);
?>
<center>
<form method="GET" action="https://www.free-kassa.ru/merchant/cash.php">
	<input type="hidden" name="m" value="<?=$fk_merchant_id?>">
	<input type="hidden" name="oa" value="<?=$sum?>"> 
	<input type="hidden" name="s" value="<?=$hash?>">
	<input type="hidden" name="us_id" value="<?=$uid;?>">
	<input type="hidden" name="o" value="<?=$order_id;?>" />
	<input type="submit" value="Оплатить через FreeKassa" class="btn btn-lg btn-success">
</form>
</center>


<?PHP

return;
}

?>

<div class="row text-center text-uppercase">
<div class="col-lg-6">
<div class="card">
<h5 class="card-header">Пополнить баланс через <b>FREEKASSA</b></h5>
<div class="card-body">

<script type="text/javascript">
	var cf= 1;
function generateThis() {
	var sum=document.getElementById("getsum").value;
	var mn=sum*cf;
	var pro=0;

<?php
$bbb= $db->query('SELECT * FROM db_percent WHERE type = 1  ORDER BY sum_a < sum_a DESC LIMIT 7')->fetchAll();
foreach ($bbb as $inb) {
?>
        if(sum><?=$inb['sum_a']-1; ?>){ mn=sum*cf;pro=<?=$inb['sum_x']; ?>;}
<?php
	}
?>

	$("#d1").html(pro *100);
	$("#d2").html( (mn=sum*pro ).toFixed(2));	
	$("#d3").html( (sum*1).toFixed(2));	
}

</script>
<form action="" method="post">
<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-ruble-sign"></i></span></div>
	<input type="number" class="form-control" value="100" min="1" max="15000" name="sum" onkeyup="generateThis();" id="getsum" />
</div>

<div class="card bg-light mb-2">
<div class="p-2">
Получаете: <b id="d3"></b> <small>РУБ.</small>
 <span class="badge badge-warning p-1" style="font-size: 100%"><small>Бонус:</small> <b id="d2"></b> <small>РУБ.</small> (+<b id="d1"></b>%)</span><br/>
</div>
</div>
	<input type="submit" value="Перейти к оплате" class="btn btn-lg btn-success"/>
</form>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="card">
<h5 class="card-header">Способы оплаты:</h5>
<div class="card-body">
FKWALLET, Яндекс.Деньги, Qiwi, Payeer, Advcash, Perfect Money, VISA,  BITCOIN, ETHEREUM, Monero, Dogecoin, DASH, LITECOIN, Steam Pay, Exmo, МТС, ТЕЛЕ2, МЕГАФОН, БИЛАЙН, Сбербанк Онлайн.<hr>
<b>Коммисия при пополнении 0%</b>
</div>
</div>
</div>

<script>
	var sum=document.getElementById("getsum").value;
	var pro=0.03;
	var mn=sum*pro;
	$("#d1").html(pro *100);
	$("#d2").html( (mn=sum*pro ).toFixed(2));	
	$("#d3").html( (sum*1).toFixed(2));		
</script>
</div>

<?php } ?>