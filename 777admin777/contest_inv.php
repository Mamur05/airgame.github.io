<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
?>
<h3>Конкурс инвесторов</h3>
<div class="btn-group mb-2 text-uppercase">
<a class="btn btn-outline-success" href="/<?=$adm;?>/contest_inv">Активный</a>
<a class="btn btn-outline-danger" href="/<?=$adm;?>/contest_inv/list">Завершенные</a>
<a class="btn btn-success" href="/<?=$adm;?>/contest_inv/add">Добавить</a>
</div>

<?php
# Добавление конкурса
if($pg->segment[2] === 'add'){
	$db->Query("SELECT * FROM db_contest_inv WHERE status = '0'");
	if($db->NumRows() > 0){
	echo '<div class="alert alert-danger">Завершите прошлый конкурс, чтобы создать новый</div>'; 
return;
?> 

<?php
}

# Создание конкурса
if(isset($_POST["add"])){

	$p1 = (intval($_POST["1m"]) > 0) ? intval($_POST["1m"]) : 0;
	$p2 = (intval($_POST["2m"]) > 0) ? intval($_POST["2m"]) : 0;
	$p3 = (intval($_POST["3m"]) > 0) ? intval($_POST["3m"]) : 0;
	$p4 = (intval($_POST["4m"]) > 0) ? intval($_POST["4m"]) : 0;
	$p5 = (intval($_POST["5m"]) > 0) ? intval($_POST["5m"]) : 0;
	$endc = time() + intval($_POST["duration"]) * 86400;
	$addc = time();
		
	if($p1 > $p2 AND $p2 > $p3 AND $p3 > $p4 AND $p4 > $p5){

	$db->query('INSERT INTO db_contest_inv (1m, 2m, 3m, 4m, 5m, date_add, date_end) VALUES (?,?,?,?,?,?,?)', array($p1, $p2, $p3, $p4, $p5, $addc, $endc));

		echo '<div class="alert alert-success">Конкурс успешно создан</div>'; return;
	}
else {
		echo '<div class="alert alert-dangrt">Чем выше место в  конкурсе тем дороже приз, делайте все правильно!</div>';
	}
}
?>
<center>
<div class="card mb-5" style="max-width: 480px;">
<div class="card-header">Создать конкурс инвесторов</div>
<div class="p-2">
<form action="" method="post">
<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text">Продолжительность</span></div>
	<input class="form-control" type="text" name="duration" value="30"/>
	<div class="input-group-append"><span class="input-group-text">ДНЕЙ</span></div>
</div>

<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text">Приз за 1-место</span></div>
	<input class="form-control" type="text" name="1m" value="1000"/>
	<div class="input-group-append"><span class="input-group-text">РУБ.</span></div>
</div>

<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text">Приз за 2-место</span></div>
	<input class="form-control" type="text" name="2m" value="500"/>
	<div class="input-group-append"><span class="input-group-text">РУБ.</span></div>
</div>

<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text">Приз за 3-место</span></div>
	<input class="form-control" type="text" name="3m" value="250"/>
	<div class="input-group-append"><span class="input-group-text">РУБ.</span></div>
</div>

<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text">Приз за 4-место</span></div>
	<input class="form-control" type="text" name="4m" value="150"/>
	<div class="input-group-append"><span class="input-group-text">РУБ.</span></div>
</div>

<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text">Приз за 5-место</span></div>
	<input class="form-control" type="text" name="5m" value="50"/>
	<div class="input-group-append"><span class="input-group-text">РУБ.</span></div>
</div>
<button type="submit" name="add" class="btn btn-success"><b>СОЗДАТЬ КОНКУРС</b></button>
</form>
</div>
</div>
</center>

<?PHP
return;
}

# Список конкурсов
if($pg->segment[2] === 'list'){

	# Список пользователей
	$db->Query("SELECT * FROM db_contest_inv WHERE status > 0");
	if($db->NumRows() > 0){

$list = $db->query("SELECT * FROM db_contest_inv WHERE status > 0")->fetchAll();
echo '<div class="row m-0">';
	foreach ($list as $e) {
?>

<div class="col-lg-4 col-md-6 p-2">
<div class="card mb-2"><div class="p-2">
ID: <b><?=$e["id"]; ?></b><span class="float-right text-danger text-uppercase"><b><?=($e["status"] > 1) ? "Отменен" : "Завершен"; ?></b></span><br/>
СТАРТ: <b><?=date("d.m.Y H:i", $e["date_add"]); ?></b><br/>
КОНЕЦ: <b><?=date("d.m.Y H:i", $e["date_end"]); ?></b><br/>
ФОНД: <b><?=$e["1m"]+$e["2m"]+$e["3m"]+$e["4m"]+$e["5m"]; ?> RUB</b>
<table class="table table-sm">
<thead>
	<th>#</th>
	<th>Логин</th>
	<th>Приз</th>
</thead>
<tr>
	<td>1</td>
	<td><?=$e["user_1"]; ?></td>
	<td><?=$e["1m"]; ?></td>
</tr>
<tr>
	<td>2</td>
	<td><?=$e["user_2"]; ?></td>
	<td><?=$e["2m"]; ?></td>
</tr>
<tr>
	<td>3</td>
	<td><?=$e["user_3"]; ?></td>
	<td><?=$e["3m"]; ?></td>
</tr>
<tr>
	<td>4</td>
	<td><?=$e["user_4"]; ?></td>
	<td><?=$e["4m"]; ?></td>
</tr>
<tr>
	<td>5</td>
	<td><?=$e["user_5"]; ?></td>
	<td><?=$e["5m"]; ?></td>
</tr>
</table>
</div></div>
</div>

		<?PHP
		} echo '</div>';
	}
	else echo '<div class="alert alert-info">Нет завершенных конкурсов</div>'; return;
}

$cnf = $db->Query("SELECT * FROM db_conf WHERE id = '1'")->fetchArray();

# Отмена
if(isset($_POST["cancel"])){

$cancel = intval($_POST["cancel"]);
	$db->Query("SELECT * FROM db_contest_inv WHERE status = '0' AND id = '{$cancel}' LIMIT 1");
	if($db->NumRows() == 1){
		$db->Query("UPDATE db_contest_inv SET user_1 = '-', user_2 = '-', user_3 = '-',user_4 = '-',user_5 = '-', status = '2' WHERE id = '$cancel'");
		$db->Query("TRUNCATE TABLE db_contest_inv_u");
		echo  '<div class="alert alert-warning">Конкурс отменен, призы НЕ зачислены</div>';
	} else echo '<div class="alert alert-danger">Конкурс с указанным ID не найден, возможно уже завершен</div>';
}

# Завершение конкурса
if(isset($_POST["set_ok"])){

	$sok = intval($_POST["set_ok"]);
	$db->query("SELECT * FROM db_contest_inv WHERE status = '0' AND id = '$sok' LIMIT 1");
	if($db->NumRows() == 1){

		$comp_p = $db->FetchArray();

		$us = array();
		$us[1] = "-";
		$us[2] = "-";
		$us[3] = "-";	
		$us[4] = "-";	
		$us[5] = "-";		
		$counter = 1;

	# Зачисляем бонус
	$ok = $db->query("SELECT * FROM db_contest_inv_u WHERE points > 0 ORDER BY points DESC LIMIT 5")->fetchAll();
	foreach($ok as $d) {
			$user_up_id = $d['uid'];
			$us[$counter] = $d['login'];
			$money = $comp_p[''.$counter.'m'];
			$money = ($money * $cnf['coint']); 

			# Зачисляем средства победителям
			$db->query("UPDATE db_users SET money_p = money_p + '$money' WHERE id = '$user_up_id'");
			$counter++;
		}
 
		$db->Query("UPDATE db_contest_inv SET user_1 = '$us[1]', user_2 = '$us[2]', user_3 = '$us[3]', user_4 = '$us[4]', user_5 = '$us[5]', status = 1 WHERE id = '$sok'");
		$db->Query("TRUNCATE TABLE db_contest_inv_u");
		echo '<div class="alert alert-success">Конкурс завершен, призы зачислены</div>';

	} else echo '<div class="alert alert-danger">Конкурс с указанным ID не найден, возможно уже завершен</div>';
}
?>

<?php
$rows = $db->query("SELECT * FROM db_contest_inv WHERE status = 0 LIMIT 1")->numRows();
if($rows == 1){

$comp = $db->FetchArray();	
?>
<div class="text-uppercase">
<h4><b>Конкурс инвесторов № <?=$comp["id"]; ?> <br/>
Общий призовой фонд: <?=$comp["1m"]+$comp["2m"]+$comp["3m"]+$comp["4m"]+$comp["5m"]; ?> Руб.</h4><hr>
<h5>
Старт конкурса: <?=date("d.m.Y в H:i:s", $comp["date_add"]); ?> <BR />Завершение: <?=date("d.m.Y в H:i:s", $comp["date_end"]); ?>
</h5>
<h5 class="text-danger"><b>
<u>Призовые места:</u><br/>
1 - <?=$comp["1m"]; ?> Руб<br/>
2 - <?=$comp["2m"]; ?> Руб<br/>
3 - <?=$comp["3m"]; ?> Руб<br/>
4 - <?=$comp["4m"]; ?> Руб<br/>
5 - <?=$comp["5m"]; ?> Руб<br/></b>
</h5>
<?=($comp["date_end"] < time()) ? '<center><font color = "red">!ДАТА ОКОНЧАНИЯ КОНКУРСА ПРОШЛА!</font></center>' : false; ?>
</b>
</div>

<center>
	<form action="" method="post">
		<input type="hidden" name="set_ok" value="<?=$comp["id"]; ?>" />
		<button class="btn btn-lg btn-success" type="submit" />Завершить и зачислить призы</button>
	</form>
	<form action="" method="post">
		<input type="hidden" name="cancel" value="<?=$comp["id"]; ?>" />
		<input class="btn btn-sm btn-outline-danger" type="submit" value="Отменить без призов"  />
	</form>
</center>

<table class="table table-bordered">
<thead>
	<th width="55">Позиция</th>
	<th>Пользователь</th>
	<th>Баллов</th>
	<th>Приз</th>
</thead>
<?php
$position = 1;

$datas = $db->query("SELECT * FROM db_contest_inv_u WHERE points > 0 ORDER BY points DESC LIMIT 50")->fetchAll();
foreach ($datas as $li) {
?>
	<tr>
		<td width="50"><?=$position; ?></td>
		<td><?=$li['login']; ?></td>
		<td><?=sprintf("%.0f",$li["points"]); ?></td>
		<td><?=(!empty($comp["{$position}m"]) > 0) ? $comp["{$position}m"]." РУБ." : "-" ?></td>
	</tr>
<?php
	$position++;
	}
?>
</table>
<?php
	}	else echo '<div class="alert alert-danger">В данный момент конкурс не проводится</div>';
?>