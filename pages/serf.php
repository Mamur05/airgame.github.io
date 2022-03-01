<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}

# Заголовки
$opt = array(
'title' => 'Серфинг сайтов',
'keywords' => 'скрипт, пчелы, игра, бонусы, серфинги, фрукты, сайты, фермы',
'description' => 'Начни зарабатывать реальные деньги на серфинге без вложений.');
?>
<div class="wrapper">
<center><h5>На серфинге, можно зарабатывать просматривая сайты, без вложений, либо рекламировать свои ссылки.</h5></center>
<?

$numb =  $db->query("SELECT * FROM `db_serf` WHERE `balance` >= `price` AND status = 'active'")->numRows();
        if($numb < 1){
			echo '<div class="alert alert-warning text-center">Нету ссылок для просмотра!</div>';
		}
?>
<?

$list = $db->query("SELECT * FROM `db_serf` WHERE `balance` >= `price` and `status` = 'active' ORDER BY price DESC, balance DESC")->fetchAll();

foreach ($list as $serf) {
	 if (isset($visits[$serf['id']])) continue;
$item = $db->query("SELECT * FROM `db_serf_item` WHERE `p_user` = '".$serf['price']."'")->fetchArray();
$eye = $serf['balance']/$item['p_user'];
?>
<div class="card serf mb-1" style="overflow: hidden;">
<div class="row"><div class="col-lg-10">
<div class="card-title p-1 mb-0">
<a class="serf-link" href="<?=$serf['url'];?>" title="Нажми для просмотра" target="_blank"><img src="https://www.google.com/s2/favicons?domain=<?=$serf['url'];?>"> <?=$serf['title'];?></a><br/>
<small style="color: #797b8b;"><i class="fa fa-eye"></i> осталось. <?=sprintf("%.0f",$eye);?> визитов. <i class="far fa-clock"></i> таймер <?=$item['timer'];?> сек.
</small>
</div></div>
<div class="col-lg-2 bg-dark text-center">
<b style="font-size: 150%;"><?=$serf['price'];?></b> <i class="fa fa-ruble-sign"></i><br/><small>Оплата</small>
</div>
</div>
</div>
<?
}
?>
</div>