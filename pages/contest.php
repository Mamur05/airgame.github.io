<?php if(!defined('FastCore')){exit('Opss!');}
$opt = array(
'title' => 'Конкурсы',
'keywords' => 'Конкурс фф, конкурс рефералов, конкурс инвесторов',
'description' => 'Конкурс рефералов и конкурс инвесторов, акции сайта'
);
?>
<div class="text-center wrapper">
<p>
За каждое действие вами или вашим рефералом в момент проведения конкурса начисляются <br/>баллы, <b>1 RUB = 1 балл.</b> Чем больше у Вас баллов, тем больше шанс победить в конкурсе. <br/>
В конкурсе может участвовать любой желающий и занять 1-е призовое место.
</p> 
<div class="m-1 row">


<div class="col-lg-6 p-1"><div style="background: rgba(255,255,255,0.2);border: 1px solid rgba(25,25,25,0.1);border-radius: 4px;padding-top: 7px;">
<?php
$ins = $db->query("SELECT * FROM db_contest_inv WHERE status = 0 LIMIT 1")->numRows();
if($ins == 1) {
$inv = $db->fetchArray();
?>
<center>
<b style="font-size: 24px;text-transform: uppercase;">Конкурс инвесторов <span class="text-primary">№<?=$inv["id"]; ?></span></b><br/>
<hr class="my-2">
<b style="text-transform: uppercase;" class="text-success">Старт: <?=date("d/m/Y в H:i", $inv["date_add"]); ?></b><br/>
<b style="text-transform: uppercase;" class="text-danger">Завершение: <?=date("d/m/Y в H:i", $inv["date_end"]); ?></b>
</center>
<center><img src="/img/prize2.png" style="max-width: 95%;"></center>
<div class="text-center" style="margin-top: -50px;line-height: 1.2;"><b class="text-primary" style="font-size: 190%;">
<?=$inv["1m"]+$inv["2m"]+$inv["3m"]+$inv["4m"]+$inv["5m"]; ?> РУБ.</b> <br/><small>ПРИЗОВОЙ ФОНД</small><hr class="my-2">
</div>
<p style="text-align:center;"><small>В конкурсе участвуют все пользователи проекта которые за время проведения конкурса пополнили свой баланс на наибольшую сумму.</small>
</p>
<?php
$nodep = $db->query("SELECT * FROM db_contest_inv_u WHERE points > 0 LIMIT 1")->numRows();
if($nodep == 1) {
?>
<center>
<h5><b>ТАБЛИЦА 20 ЛИДЕРОВ</b></h5>
<table class="table table-sm table-bordered text-center mb-0">
<thead>
	<th width="55">Позиция</th>
	<th>Пользователь</th>
	<th>Баллов</th>
	<th>Приз</th>
</thead>
<?php 
$position = 1;
$invl = $db->query("SELECT * FROM db_contest_inv_u WHERE points > 0 ORDER BY points DESC LIMIT 20")->fetchAll();
foreach ($invl as $li) {
?>
	<tr>
		<td width="50"><?=$position; ?></td>
		<td><?=$li['login']; ?></td>
		<td><?=sprintf("%.0f",$li["points"]); ?></td>
		<td><?=(!empty($inv["{$position}m"]) > 0) ? $inv["{$position}m"]." РУБ." : "-" ?></td>
	</tr>
<?php
$position++; 
	}
?>
</table>
</center>
<?php	
		} else echo '<div class="alert alert-danger text-center m-2">В конкурсе пока нет участников</div>'; 
	} else { echo '<div class="alert alert-danger text-center m-2">На данный момент конкурс инвесторов не проводится</div>'; 
}
?>
</div></div>


<div class="col-lg-6 p-1"><div style="background: rgba(255,255,255,0.2);border: 1px solid rgba(25,25,25,0.1);border-radius: 4px;padding-top: 7px;">
<?php
$refs = $db->query("SELECT * FROM db_contest_ref WHERE status = 0 LIMIT 1")->numRows();
if($refs == 1) {
$ref = $db->fetchArray();
?>
<center>
<b style="font-size: 24px;text-transform: uppercase;">Конкурс рефоводов <span class="text-danger">№<?=$ref["id"]; ?></span></b><br/>
<hr class="my-2">
<b style="text-transform: uppercase;" class="text-success">Старт: <?=date("d/m/Y в H:i", $ref["date_add"]); ?></b><br/>
<b style="text-transform: uppercase;" class="text-danger">Завершение: <?=date("d/m/Y в H:i", $ref["date_end"]); ?></b>
</center>
<center><img src="/img/prize1.png" style="max-width: 95%;"></center>
<div class="text-center" style="margin-top: -50px;line-height: 1.2;"><b class="text-danger" style="font-size: 190%;">
<?=$ref["1m"]+$ref["2m"]+$ref["3m"]+$ref["4m"]+$ref["5m"]; ?> РУБ.</b> <br/><small>ПРИЗОВОЙ ФОНД</small><hr class="my-2">
</div>
<p style="text-align:center;"><small>
В конкурсе выигрывает тот у кого больше активных рефералов, которые пополнили свой баланс за время проведения конкурса на наибольшую сумму.</small>
</p>
<?php
$noref = $db->query("SELECT * FROM db_contest_ref_u WHERE points > 0 LIMIT 1")->numRows();
if($noref == 1) {
?>
<center>
<h5><b>ТАБЛИЦА 20 ЛИДЕРОВ</b></h5>
<table class="table table-sm table-bordered text-center mb-0">
<thead>
	<th width="55">Позиция</th>
	<th>Пользователь</th>
	<th>Баллов</th>
	<th>Приз</th>
</thead>
<?php 
$position = 1;
$refl = $db->query("SELECT * FROM db_contest_ref_u WHERE points > 0 ORDER BY points DESC LIMIT 20")->fetchAll();
foreach ($refl as $li) {
?>
	<tr>
		<td width="50"><?=$position; ?></td>
		<td><?=$li['login']; ?></td>
		<td><?=sprintf("%.0f",$li["points"]); ?></td>
		<td><?=(!empty($ref["{$position}m"]) > 0) ? $ref["{$position}m"]." РУБ." : "-" ?></td>
	</tr>
<?php
$position++; 
	}
?>
</table>
</center>
<?php	
		} else echo '<div class="alert alert-danger text-center m-2">В конкурсе пока нет участников</div>'; 
	} else { echo '<div class="alert alert-danger text-center m-2">На данный момент конкурс рефералов не проводится</div>'; 
}
?>
</div></div>
</div>
</div>