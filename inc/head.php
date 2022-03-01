<?php if(!defined('FastCore')){exit();} ?>
<!DOCTYPE html>
<html>
<head>

	<title>AirGame - {!TITLE!} </title>
    <?php if (empty($pg->segment[0] ==='user')) { ?>
	<meta name="description" content="{!DESCRIPTION!}">
	<meta name="keywords" content="{!KEYWORDS!}">
	<meta property="og:image" content="/img/home.png">
	<?php 
    }
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="yandex-verification" content="923346b0dff67ae9" />
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script>new WOW().init();</script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <?php
 if(($_SERVER['REQUEST_URI'] !== '/reg')
and($_SERVER['REQUEST_URI'] != '/login')
and($_SERVER['REQUEST_URI'] != '/login/')
and($_SERVER['REQUEST_URI'] != '/restore')
and($_SERVER['REQUEST_URI'] != '/stats')
and($_SERVER['REQUEST_URI'] != '/serf')
and($_SERVER['REQUEST_URI'] != '/user/bonus')
and($_SERVER['REQUEST_URI'] != '/user/bonus2')
and($_SERVER['REQUEST_URI'] != '/user/bonus3')
and($_SERVER['REQUEST_URI'] != '/user/serf')
and($_SERVER['REQUEST_URI'] != '/user/serf/add')
and($_SERVER['REQUEST_URI'] != '/user/serf/edit')
and($_SERVER['REQUEST_URI'] != '/user/serf/cabinet')
) { 
?>
<script data-ad-client="ca-pub-3734850630008787" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php
    } 
?>
</head>
<body>

<?
// Свежие новости для пользователя
$numnews = $db->query("SELECT id FROM db_news ORDER BY id DESC")->fetchAll();
$nnews = count($numnews);
$u_news = $db->query('SELECT id,news FROM db_users WHERE id = '.$uid.'')->fetchArray();
$newsus = $u_news['news'] ?? 0;

?>
<style>
#blink {color: #fca;animation: pulse 1s infinite;}
@keyframes pulse{from{color: #ff5b83;text-shadow: 1px 1px 0px #534;}}
</style>

<div class="header_line">
<div class="header">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark text-uppercase"><div class="container container-body">
<a class="navbar-brand" href="/"><b><span class="text-info">AIR</span>GAME</b></a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
	<ul class="navbar-nav mr-auto">

	<?php if($nnews == ($newsus ?? 0)) { ?>
	<li class="nav-item"><a class="nav-link" href="/news">Новости</a></li>
	<?php } else { ?>
	<li class="nav-item"><a class="nav-link" href="/news"><font id="blink">Новости</font></a></li>
	<?php } ?>
    <li class="nav-item"><a class="nav-link" href="/about">О нас</a></li>
	<li class="nav-item"><a class="nav-link" href="/contest">Конкурсы</a></li>
	<li class="nav-item"><a class="nav-link" href="/stats">Статистика</a></li>
	<li class="nav-item"><a class="nav-link" href="/reviews">Отзывы</a></li>
	<li class="nav-item"><a class="nav-link" href="/help">Помощь</a></li>

	<li class="nav-item"><a href="#" onclick="doGTranslate('ru|ru');return false;" title="Russian" class="nav-link gflag nturl" style="margin:0;margin-top: 5px;padding: 0 !important;background-position:-500px -200px;max-width: 32px !important;"><img src="//gtranslate.net/flags/blank.png" height="22" width="32" alt="Ru" /></a></li>
	<li class="nav-item"><a href="#" onclick="doGTranslate('ru|en');return false;" title="English" class="nav-link gflag nturl" style="background-position:-0px -0px;margin:0;margin-top: 5px;padding: 0 !important;max-width: 32px !important;"><img src="//gtranslate.net/flags/blank.png" height="22" width="32" alt="En" /></a></li>
	</ul>
	<ul class="navbar-nav navbar-right">
<?php if ($uid) : ?>
	<li class="nav-item"><a class="nav-link" href="/user/dashboard"><i class="fa fa-user"></i> <b>Профиль</b></a></li>
<?php endif;?>
<?php if (!$uid) : ?>
	<li class="nav-item reg"><a class="nav-link btn-danger" href="/reg"><b>Регистрация</b></a></li>
	<li class="nav-item login"><a class="nav-link btn-success" href="/login"><b>Вход</b></a></li>
<?php endif;?>
	</ul>
	</div>
</div>
</nav>

</div></div>

<?php
 if(($_SERVER['REQUEST_URI'] !== '/restore')
and($_SERVER['REQUEST_URI'] != '/user/bonus')
and($_SERVER['REQUEST_URI'] != '/user/bonus2')
and($_SERVER['REQUEST_URI'] != '/login')
and($_SERVER['REQUEST_URI'] != '/reg')
) { 
?>
<div class="container-body mb-0" style="padding: 10px 15px 0;">
<center class="row">
<div class="col-lg-6" style="overflow-y: hidden;">
    <center style="height: 62px;" class="m-1">
        <div id="linkslot_321973"><script src="https://linkslot.ru/bancode.php?id=321973" async></script></div>
    </center>
</div>
<div class="col-lg-6" style="overflow-y: hidden;">
    <center style="height: 62px;" class="m-1">
       <div id="linkslot_322267"><script src="https://linkslot.ru/bancode.php?id=322267" async></script></div>
    </center>
</div>
</center>
</div>
<?php
}
?>

<?php if (empty($pg->segment[0] ==='') && empty($pg->segment[0] ==='i') && empty($pg->segment[0] ==='user')) { ?>

<center><h3 class="text-center text-uppercase wrapper-title shadow-sm"><b>{!TITLE!}</b></h3></center>
<div class="container-body"><div class="mt-2">
<?php 
} else { 
	echo '<div class="mt-1"></div>'; 
}
?>
