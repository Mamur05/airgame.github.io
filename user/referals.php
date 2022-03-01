<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Рефералы';

$refs = $user['refs'];
$income = $user['income'];
?>

<div class="bg-light text-center p-1"><b>РЕФЕРАЛЬНАЯ ПРОГРАММА 3-УРОВНЯ. 8% НА ВЫВОД!</b><br/>
Приглашайте в людей по своей реферальной ссылке, размещая на различных сайтах!<br>
Вы будете получать 5%-2%-1% от каждого пополнения баланса вашим рефералом 
(и их рефералами) на вывод!<br>
Ниже представлена ссылка для привлечения и количество приглашенных Вами людей.
</div>

<div class="card-body">
<div class="row">
<center class="col-xl-6">
<center>
<div class="card-group text-uppercase mb-3">
<div class="card card-body"><center><i class="fa fa-users text-warning" style="font-size: 170%;"></i><br/><b><?=$refs; ?> чел.</b><br/><small>Количество рефералов: </small></center></div>
<div class="card card-body"><center><i class="fa fa-coins text-success" style="font-size: 170%;"></i><br/><b><?=$income; ?> руб.</b><br/><small>Реферальный доход:</small></center></div>
</div></center>
</center>

<div class="col-xl-6">
<label class="text-uppercase"><b>Ваша ссылка для привлечения рефералов:</b></label>
<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-link"></i></span></div>
	<input type="text" onclick="this.select()" class="form-control" value="https://<?=$_SERVER['HTTP_HOST']; ?>/i/<?=$uid; ?>">
</div>

<center>
<button type="button" class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#demo"><i class="far fa-image"></i> Рекламные материалы</button>
</center>

</div>
</div>
</div>



<div id="demo" class="collapse"><hr>
<div class="row m-3">

<div class="col-md-8">
<div class="card">
<div class="p-2"><h5 class="card-title">Размер баннера: <b>468х60</b></h5>
<img src="/img/promo/468.gif" alt="468x60">
<div class="pt-2"><input type="text" onclick="this.select()" class="form-control" value="https://<?=$_SERVER['HTTP_HOST']; ?>/img/promo/468.gif"></div>
</div></div>
<div class="card mt-2 mb-2">
<div class="p-2"><h5 class="card-title">Размер баннера: <b>728х90</b></h5>
<img src="/img/promo/728.gif" style="width: 100%;" alt="728x90">
<div class="pt-2"><input type="text" onclick="this.select()" class="form-control" value="https://<?=$_SERVER['HTTP_HOST']; ?>/img/promo/728.gif"></div>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card">
<div class="p-2"><h5 class="card-title">Размер баннера: <b>200х300</b></h5>
<img src="/img/promo/200.gif" alt="200x300">
<div class="pt-2"><input type="text" onclick="this.select()" class="form-control" value="https://<?=$_SERVER['HTTP_HOST']; ?>/img/promo/200.gif"></div>
</div>
</div>
</div>

</div><hr>
</div>


<div class="pt-3">
<h4 class="card-title text-center">Список ваших рефералов:</h4>
<table class="table table-striped table-bordered nowrap text-center table-sm">
<thead>
<tr>
	<th> Логин</th>
	<th> Доход от партнера</th>
	<th> Откуда пришел</th>
	<th> Дата регистрации</th>
</tr>
</thead>
<?PHP
$ref = $db->query("SELECT login, ref_to, refsite, reg FROM db_users WHERE id = id AND rid = '$uid' ORDER BY ref_to DESC")->fetchAll();
	foreach($ref as $r){
?>
<tr>
	<td><?=$r['login']; ?></td>
	<td><?=sprintf("%.2f",$r['ref_to']); ?></td>
	<td><?=$r['refsite']; ?></td>
	<td><?=date("d.m.Y в H:i",$r['reg']); ?></td>
</tr>
<?PHP
	}
?>
</table>
</div>