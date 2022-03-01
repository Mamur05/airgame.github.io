<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}
$opt = array(
'title' => 'Новости',
'keywords' => 'новости сайта, уведомления для сайта, оповещение пользователям, события',
'description' => 'Самые свежие и актуальные новости на нашем сайте, о конкурсах и акциях, прочитай чтобы не пропустить.'
);

?>
<div class="wrapper">
<?php
# Полная новость
if(isset($pg->segment[1]) && $pg->segment[1] === 'i') {
$url_news = filter_var($pg->params[1], FILTER_SANITIZE_STRING);
$news = $db->query('SELECT * FROM db_news WHERE url = ? LIMIT 1',array($url_news))->fetchArray();
if(isset($news['url']) == 0) {
	echo '<div class="alert alert-danger m-2">Новость не найдена</div></div>'; return;
}

?>
<div class="card">
<h4 class="card-title m-2 mb-0 pt-2"><span style="font-size: 120%;"><i class="fas fa-chevron-circle-right text-warning"></i> <b><?=$news['title'];?></b></span> <small class="float-right badge badge-light" style="position: relative;top: -5px;"><?=date("d.m.Y в H:i",$news['add']); ?><br/><small>Публикация:</small> </small></h4>
<hr class="my-0">
<div><img src="<?=$news['img']; ?>" alt="#<?=$news['title']; ?>" class="img-rounded m-2" style="max-height: 256px;"></div>
<p class="p-2" style="font-size: 110%;"><?=$news['text'];?></p>
</div>
<h4>Читайте также:</h4>
<?php
$news = $db->query('SELECT * FROM `db_news` ORDER BY `id` DESC LIMIT 3')->fetchAll();
foreach ($news as $news) { 

$news_t = $news['text']; // краткая новость
?>

<div class="p-2" style="border-top: #e7e7e7 1px solid;"><h5 class="card-title mb-0"><small><i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></small> <b> <a href="/news/i/<?=$news['url']; ?>" title="Прочитать новость"><?=$news['title']; ?><span class="badge"> - <b><?=date("d.m.Y в H:i",$news['add']); ?></b></span></a></b>
</h5></div>
<?php
	}
	echo '</div>'; return;
} 
?>



<?php

if(isset($uid)) {
# Считаем непрочитаные новости
$numnews = $db->query("SELECT id FROM db_news ORDER BY id DESC")->fetchAll();
$nnews = count($numnews);
$u_news = $db->query('SELECT id,news FROM db_users WHERE id = '.$uid.'')->fetchArray();
$newsus = $u_news['news'] ?? 0;
	if($nnews > $newsus) {
		$db->query('UPDATE db_users SET news = '.$nnews.' WHERE id = '.$uid.'');
	//	header("Location: /news");
	}
}

# Текущая страница
$rows = $db->query("SELECT * FROM `db_news` WHERE `id` > 0")->numRows();

# Пагинация
$cnt = 3;
$nav ='/news';
$page = $pg->params[1] ?? 1;
$start = ($page * $cnt) - $cnt;
$str_pag = ceil($rows / $cnt);

if($rows == 0) {
	echo '<div class="alert alert-danger">На данный момент новости не были опубликованы.</div>';
} 
else {

$news = $db->query('SELECT * FROM `db_news` ORDER BY `id` DESC LIMIT 1')->fetchAll();
foreach ($news as $news) { 

$news_t = $news['text']; // 1-новость
?>
<div class="card m-2" style="font-size: 125%;">
<div class="p-2"><h4 class="card-title mb-0"><b> <?=$news['title']; ?></b></h4><hr class="my-2"> 

<img src="<?=$news['img']; ?>" alt="#<?=$news['title']; ?>" class="img-rounded" style="max-height: 256px;">
<p><?=$news_t; ?></p>
<span class="badge badge-success"> #<b><?=$news['id']; ?></b></span>
<span class="badge badge-danger"><b>НОВОЕ</b></span>
<span class="badge badge-light"> Публикация: <b><?=date("d.m.Y в H:i",$news['add']); ?></b></span>
</div>
</div><hr>
<?php
	}
$news = $db->query('SELECT * FROM `db_news` ORDER BY `id` DESC LIMIT '.$start.','.$cnt.'')->fetchAll();
foreach ($news as $news) { 

$news_t = mb_substr(stripslashes($news['text']), 0, 500); // краткая новость
?>
<div class="card m-2">
<div class="p-2"><h5 class="card-title mb-0"><small><i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></small> <b> <a href="/news/i/<?=$news['url']; ?>" title="Прочитать всю новость"><?=$news['title']; ?></a></b></h5>
<hr class="my-1"> 
<p><?=$news_t; ?>...</p>
<span class="badge badge-warning"> #<b><?=$news['id']; ?></b></span>
<span class="badge badge-light"> Публикация: <b><?=date("d.m.Y в H:i",$news['add']); ?></b></span>
</div>
</div>
<?php
	}
	# Выводим пагинацию
	if ($rows > $cnt) {
	echo '<ul class="pagination m-2"><li class="page-item"><a class="page-link" href="'.$nav.'">«</a></li>';
	for ($i = 1; $i <= $str_pag; $i++){
		echo '<li class="page-item"><a class="page-link" href="'.$nav.'/p/'.$i.'">'.$i.'</a></li>';
		}
	echo '<li class="page-item"><a class="page-link" href="'.$nav.'/p/'.$str_pag.'">»</a></li></ul>';
	}

}
?>
</div>