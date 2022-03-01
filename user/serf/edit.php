<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt['title'] = 'Редактирование ссылки';
include 'serf_menu.php';
?>
<div class="row">
<?PHP
if(isset($_POST['serf_id'])){
    $serf_id = filter_var($_POST['serf_id'],FILTER_VALIDATE_INT);
    if($serf_id === FALSE){
       Header('Location: /user/serf/cabinet'); return;
    }
    $db->query("SELECT * FROM `db_serf` WHERE `id` = '$serf_id'");
    if($db->numRows() == 0){
         Header('Location: /user/serf/cabinet'); return;
    }
    $result = $db->fetchArray();
    if($result['uid'] != $uid && $uid != 1){
        Header('Location: /user/serf/cabinet'); return;
    }
    $title = $result['title'];
    $url = $result['url'];
    ?>
    <div class="col-sm-12">
        <div class="card shadow-sm">
            <div class="card-header"><b>Редактирование площадки ID: <?=$serf_id;?></b></div>
            <div class="card-body pb-2">
<form action="" method="POST" id="serf_edit">
<div class="input-group mb-2">
<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-edit"></i></span></div>
<input class="form-control" type="text" name="title" id="title" value="<?=$title;?>" placeholder="Название ссылки" required>
</div>

<div class="input-group mb-2">
<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-link"></i></span></div>
<input class="form-control" type="text" name="url" id="url" value="<?=$url;?>" placeholder="URL сайта с https://" required>
</div>

		<input type="hidden" id="type" name="type" value="edit">
		<input type="hidden" id="edit" name="edit" value="edit">
		<input type="hidden" name="serf_id" value="<?=$serf_id;?>">
		<input type="hidden" id="request" name="request" value="/ajax.php?action=serf&type=edit">
	<button type="submit" class="btn btn-primary">Сохранить</button>
</form>
        </div></div>
    </div>
    <?PHP
}else{
    Header('Location: /user/serf/cabinet'); return;
}
?>
</div>