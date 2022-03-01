<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Профиль';

$db->Query("SELECT speed, last, id FROM db_users WHERE id = '$uid'");
$pers = $db->FetchArray();


# Профит в процентах
if (($user['sum_in'] * $user['sum_out']) != 0) { $profit = ($user['sum_out']*100)/$user['sum_in']; } else { $profit = 0; }

# Пользователь вышел
if ($pg->segment[1] === 'logout') {
session_destroy(); header('Location: /'); return;
}

?>
<br/>

<div class="row panel-c" style="margin: -2px -15px;">

<div class="col-xl-3 col-lg-6 text-center">
<div class="card card-body">
<center style="margin-top: -42px;">
<div class="btn rounded bg-success text-white p-2"><span class="fa fa-arrow-up"></span></div>
</center>
<h5 style="font-weight: 700;font-size: 145%;line-height: 1.2;"><b><?=sprintf("%.2f",$user['sum_in']); ?> РУБ.</b></h5>
<hr class="my-0">
<small>ПОПОЛНЕНО</small>
</div>
</div>

<div class="col-xl-3 col-lg-6 text-center">
<div class="card card-body">
<center style="margin-top: -42px;">
<div class="btn bg-danger rounded text-white p-2"><span class="fa fa-arrow-down"></span></div>
</center>
<h5 style="font-weight: 700;font-size: 145%;line-height: 1.2;"><b><?=sprintf("%.2f",$user['sum_out']); ?> РУБ.</b></h5>
<hr class="my-0">
<small>ВЫПЛАЧЕНО</small>
</div>
</div>

<div class="col-xl-3 col-lg-6 text-center">
<div class="card card-body">
<center style="margin-top: -42px;">
<div class="btn bg-warning rounded text-white p-2"><span class="fa fa-users"></span></div>
</center>
<h5 style="font-weight: 700;font-size: 145%;line-height: 1.2;"><b><?=sprintf("%.2f",$user['income']); ?> РУБ.</b></h5>
<hr class="my-0">
<small>РЕФ-ДОХОД</small>
</div>
</div>

<div class="col-xl-3 col-lg-6 text-center">
<div class="card card-body">
<center style="margin-top: -42px;">
<div class="btn bg-primary rounded text-white p-2"><span class="fa fa-ruble-sign"></span></div>
</center>
<h5 style="font-weight: 700;font-size: 145%;line-height: 1.2;"><b><?=sprintf("%.0f",$profit); ?>%</b></h5>
<hr class="my-0">
<small>ПРОФИТ</small>
</div>
</div>

</div>



<div class="row">

<div class="col-lg-6">
<div class="list-group">
<div class="list-group-item p-1 bg-light text-uppercase"><b>Моя статистика</b><i class="fa fa-chart-bar float-right p-1"></i> </div>
<div class="list-group-item p-1">Баланс покупок: <span class="float-right"><b><?=sprintf("%.2f",$user['money_b']); ?></b> <i class="fa fa-ruble-sign"></i></span></div>
<div class="list-group-item p-1">Баланс на вывод: <span class="float-right"><b><?=sprintf("%.2f",$user['money_p']); ?></b> <i class="fa fa-ruble-sign"></i></span></div>
<div class="list-group-item p-1">Просмотров серфинга: <span class="float-right"><b><?=$user['views']; ?></b> <i class="fa fa-eye"></i></span></div>
<div class="list-group-item p-1">Кол-во рефералов: <span class="float-right"><b><?=$user['refs']; ?></b> <i class="fa fa-users"></i></span></div>
<div class="list-group-item p-1">Реферальный доход: <span class="float-right"><b><?=sprintf("%.2f",$user['income']); ?></b> <i class="fa fa-ruble-sign"></i></span></div>
</div>
</div>

<div class="col-lg-6">
<div class="list-group">
<div class="list-group-item p-1 bg-light text-uppercase"><b>Мои данные</b><i class="fa fa-info-circle float-right p-1"></i> </div>
<div class="list-group-item p-1">Ваш ID: <span class="float-right"><b><?=$user['id'];?></b></span></div>
<div class="list-group-item p-1">Ваш псевдоним: <span class="float-right"><b><?=$user['login'];?></b></span></div>
<div class="list-group-item p-1">Ваш Email: <span class="float-right"><b><?=$user['email'];?></b></span></div>
<div class="list-group-item p-1">Дата регистрации: <span class="float-right"><b><?=date("d.m.Y в H:i",$user['reg']);?></b></span></div>
<div class="list-group-item p-1">Вас пригласил: <span class="float-right"><b><?=$user['referer'];?></b></span></div>
</div>
</div>

<div class="col-lg-12">
<div class="card card-body mt-3 bg-light">
<h5 class="card-title">Партнерская программа 3-уровня! (5-2-1% на вывод).</h5>
<div class="input-group mb-2">
	<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-link"></i></span></div>
	<input type="text" onclick="this.select()" class="form-control" value="https://<?=$_SERVER['HTTP_HOST']; ?>/i/<?=$uid; ?>">
</div>
</div>
</div>

</div>