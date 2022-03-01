<?php if(!defined('FastCore')){exit('Oops!');}
$opt['title'] = 'Цепочка ссылок';
$price_link = $db->query("SELECT price_link FROM  db_conf WHERE id = 1")->fetchArray();

?>

<div class="alert alert-success">
<b>1.</b> Покупка ссылки имеет конечный характер. Деньги возврату не подлежат.<br>
<b>2.</b> Принцип работы: более новая появляется слева, более старая сдвигается вправо.<br>
<b>3.</b> Ссылки располагаются на всех страницах сайта. Всего показывается последние 6 ссылок. <br>
</div>

<div class="row">
<div class="col-lg-12">
<div class="card m-1">
<h5 class="card-header">Добавление ссылки в витрину ссылок</h5>
<div class="p-2">
<form action="" class="mb-0" method="POST" id="link_add">

<div class="input-group mb-2">
<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-edit"></i></span></div>
<input class="form-control" name="text" id="text" placeholder="Заголовок ссылки максимум 18 символов" required>
</div>

<div class="input-group mb-2">
<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-link"></i></span></div>
<input class="form-control" name="url" id="url" placeholder="Адрес ссылки максимум 200 символов" required>
</div>

<input type="hidden" name="add">
            <input type="hidden" id="type" name="type" value="add">
            <input type="hidden" id="request" name="request" value="/ajax.php?action=links&type=add">
            <button type="submit" class="btn btn-primary mt-2">Добавить ссылку за <?=$price_link['price_link'];?> руб</button>
</form>

</div>

</div>
</div>

</div>
<br/>
<h3>Ваши ссылки в цепочке</h3>

<?
$numb =  $db->query("SELECT * FROM `db_links` WHERE uid = '$uid'")->numRows();
        if($numb < 1){
			echo '<div class="alert alert-warning text-center">У вас нету ссылок!</div>';
		}
?>
<div class="table-responsive">
<table class="table table-sm table-bordered text-center">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Заголовок</th>
      <th scope="col">Ссылка</th>
      <th scope="col">Клики</th>
    </tr>
  </thead>
  <tbody>
<?
$list = $db->query("SELECT * FROM `db_links` WHERE uid = '$uid'")->fetchAll();
foreach ($list as $list) {
?>
<tr>
      <td><?=$list['id'];?></td>
      <td><?=$list['text'];?></td>
      <td><?=$list['url'];?></td>
      <td><?=$list['count'];?></td>
    </tr>
<?
}
?>
 </tbody>
</table>

</div>