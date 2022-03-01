<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Серфинг Сайтов';
include 'serf_menu.php';
?>

<center>
<?php
if ($user['sum_in'] >= 9.99) {
?>
<b>Администрация не отвечает за рекламные ссылки размещенные в серфинге.</b> 
<?php
} else { ?>
<b>Пополните баланс на сумму от 10 рублей, оплата за просмотр сайтов будет 2 раза больше!</b> 
<?php
}
?>
</center>

<style>
.surfblockopen{background-color: #d0F0e0;border-color: #D0D0D0;color: #808080;opacity:0.3;display:none;}
.panel-success {border-width: 2px;}
</style>
<script>
function showFrame(div, link) {
  window.open('/link/'+link, '_blank');
  $(div).parent().parent().parent().parent().addClass("surfblockopen");
}
</script>
<?
$numb =  $db->query("SELECT * FROM `db_serf` WHERE `balance` >= `price` AND status = 'active'")->numRows();
        if($numb < 1){
			echo '<div class="alert alert-warning text-center">Нету ссылок для просмотра!</div>';
		}
?>
<div class="pb-2">

<?

$list = $db->query("SELECT * FROM `db_serf` WHERE `balance` >= `price` and `status` = 'active' ORDER BY price DESC, balance DESC")->fetchAll();

$list2 = $db->query("SELECT ident, time_add FROM db_serf_click WHERE uid = '$uid' AND time_add + 86400 > '".time()."'")->fetchAll();

$visits = array();
	foreach ($list2 as $list2) {
        $visits[$list2['ident']] = $list2;
    }	
foreach ($list as $serf) {
	 if (isset($visits[$serf['id']])) continue;
$item = $db->query("SELECT * FROM `db_serf_item` WHERE `p_user` = '".$serf['price']."'")->fetchArray();
$eye = $serf['balance']/$item['p_user'];

if ($user['sum_in'] <= 9){
$prc = ($serf['price']/2);
} else {
$prc = $serf['price'];
}

?>
<div class="card serf mb-1" style="overflow: hidden;">
<div class="row"><div class="col-lg-10">
<div class="card-title p-1 mb-0">
<a href="#" onclick="showFrame(this, '<?=$serf['id'];?>');" class="serf-link" title="Нажми для просмотра"><img src="https://www.google.com/s2/favicons?domain=<?=$serf['url'];?>" alt="i"> <?=$serf['title'];?></a><br/>
<small style="color: #756;"><i class="fa fa-eye"></i> осталось. <?=sprintf("%.0f",$eye);?> визитов. <i class="far fa-clock"></i> таймер <?=$item['timer'];?> сек.
</small>
</div></div>
<div class="col-lg-2 bg-dark text-center">
<b style="font-size: 150%;"><?=$prc; ?></b> <i class="fa fa-ruble-sign"></i><br/><small>Оплата</small>
</div>
</div>
</div>
<?
}
?>


</div>