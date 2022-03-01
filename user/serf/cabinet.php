<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Ваши ссылки';
include 'serf_menu.php';
?>

<?
$numb =  $db->query("SELECT * FROM `db_serf` WHERE uid = '$uid'")->numRows();
        if($numb < 1) {
			echo '<div class="alert alert-warning text-center">У вас нету ссылок!</div>';
		}
?>

<div>
<?
$list = $db->query("SELECT * FROM `db_serf` WHERE uid = '$uid' ORDER BY id DESC")->fetchAll();
foreach ($list as $serf) {
?>
<div class="mt-2" id="serf_<?=$serf['id'];?>">
<div class="card shadow-sm" >

<div class="card-title m-2">
<a href="<?=$serf['url'];?>" target="_blank"><img src="https://www.google.com/s2/favicons?domain=<?=$serf['url'];?>"> <b><?=$serf['title'];?></b>
</a>
</div>




<div class="card-footer p-0">

<div class="nav nav-pills nav-fill mt-1">
	<div class="nav-item">Баланс: <b><?=$serf['balance'];?> руб.</b>
<small class="text-danger" data-toggle="collapse" data-target="#advsum<?=$serf['id'];?>" style="cursor: pointer;"><b>[ПОПОЛНИТЬ]</b></small>
</div>
	<div class="nav-item">Просмотрено: <b><?=$serf['view'];?></b> <i class="fa fa-eye"></i></div>
	<div class="nav-item">Цена перехода: <b><?=$serf['price'];?> руб.</b></div>
</div>
<hr class="my-1">
<div class="m-1 nav nav-pills nav-fill" style="background: #624;border-radius: 1em;">

	<div class="nav-item"><form action="" method="POST" class="m-1">
<?
			if($serf['status'] == 'active'){
                echo '<button class="btn p-0 text-warning status_serf" href="#" action="deactive" title="Остановить" serf_id="'.$serf['id'].'"><i class="fa fa-pause"></i> Остановить</button>';
            }else{
                echo '<button class="btn p-0 status_serf" style="color: #afeb13;" href="#" action="active" title="Запустить" serf_id="'.$serf['id'].'"><i class="fa fa-play"></i> Запустить</button>';
            }	
?>
</form>	
	</div>

	<div class="nav-item"><form action="/user/serf/edit" method="POST" class="m-1">
<input type="hidden" name="serf_id" value="<?=$serf['id']; ?>">
<button class="btn text-info p-0" title="Редактировать"><i class="fa fa-edit"></i> Редактировать</button>
</form>
	</div>

	<div class="nav-item"><form action="" method="POST" class="m-1">
<button serf_id="<?=$serf['id'];?>" href="#" class="btn text-danger p-0 delete" title="Удалить площадку #<?=$serf['id']; ?>"><i class="fa fa-times"></i> Удалить</button>
</form>
	</div>

</div>

</div>
<div id="advsum<?=$serf['id'];?>" class="collapse">
<form class="balance_add m-3" method="POST" class="mb-0">Введите сумму пополнения:
	<div class="input-group input-group-sm">
	<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-ruble-sign"></i></span></div>
	<input type="hidden" name="serf_id" value="<?=$serf['id']; ?>">
	<input type="text" id="money" name="money" class="form-control" placeholder="Минимум: 1.00" value="1.00">
	<input type="hidden" id="type" name="type" value="add_balance">
	<div class="input-group-append"><button class="btn btn-primary"><b>ОК</b></button></div>
	</div>

<small class="text-danger">При пополнении рекламной площадки, взимается комиссия в размере 10% от суммы. </small>
</form>
</div>
</div>
</div>
<?
}
?>

</div>