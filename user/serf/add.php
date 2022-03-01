<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Добавление серфинга';
include 'serf_menu.php';
?>

<div class="row m-0">
<?
$list = $db->query("SELECT * FROM `db_serf_item`")->fetchAll();
foreach ($list as $serf) {
?>
<div class="col-lg-4 col-sm-4 p-1">
<div class="list-group mb-2">
<div class="list-group-item p-1 text-uppercase" style="color: #fc2 !important;background: #521;"><i class="fa fa-check"></i> <b><?=$serf['title'];?></b></div>
<div class="list-group-item p-1">Цена: <span class="fa-pull-right"><b><?=$serf['price'];?></b> <i class="fa fa-ruble-sign"></i> = <b>1000</b> <i class="fa fa-eye" title="Просмотров"></i></span></div>
<div class="list-group-item p-1">Оплата: <span class="fa-pull-right"><b><?=$serf['p_user'];?></b> <i class="fa fa-ruble-sign"></i></span></div>
<div class="list-group-item p-1">Таймер: <span class="fa-pull-right"><b><?=$serf['timer'];?> сек.</b> <i class="fa fa-clock"></i></span></div>
<div class="list-group-item p-1">Активное окно: <span class="fa-pull-right">
<?
if ($serf['wind'] == 1){
echo '<b class="text-success">Да <i class="fa fa-desktop"></i></b>';
} else {
	echo '<b class="text-danger">Нет <i class="fa fa-desktop"></i></b>';
}
?></span></div>
</div>
</div>
<?
}
?>
</div>


<div class="row">
<div class="col-lg-12">
<div class="card m-1">
<h5 class="card-header">Добавление ссылки</h5>
<div class="p-2">
<form action="" class="mb-0" method="POST" id="serf_add">

<div class="input-group mb-2">
<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-edit"></i></span></div>
<input class="form-control" name="title" id="title" placeholder="Придумайте название ссылки" required>
</div>

<div class="input-group mb-2">
<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-link"></i></span></div>
<input class="form-control" name="url" id="url" placeholder="Адрес ссылки пример: https://site.com" required>
</div>

<select class="form-control mt-2" name="tarif" id="tarif" required>
<?
$list = $db->query('SELECT * FROM db_serf_item')->fetchAll();
foreach($list as $serf){
?>
<option value="<?=$serf['id'];?>"><?=$serf['title'];?></option>
 <?
 }
 ?>
</select>
<input type="hidden" name="add">
            <input type="hidden" id="type" name="type" value="add">
            <input type="hidden" id="request" name="request" value="/ajax.php?action=serf&type=add">
            <button type="submit" class="btn btn-success mt-2">Добавить ссылку</button>
</form>

</div>

</div>
</div>

</div>
<br/>
