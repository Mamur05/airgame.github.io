<?php if(!defined('FastCore')){ exit('Oops!'); }

# Заголовки
$opt = array(
'title' => 'Экономическая онлайн игра',
'keywords' => 'заработок, играть, самолеты, бонусы, серф, экономическая игра, airmoney, airgame',
'description' => 'Самолеты онлайн - это экономическа игра с выводом денег, все просто, покупай самолеты - выводи деньги!'
);

# ============================
# Вставляем в куки ID referera пример: /i/123
# ============================
if (isset($pg->params[1])) {
$rid = (intval($pg->params[1]) > 0) ? intval($pg->params[1]) : 1;
setcookie('i',$rid,time()+(60*60*24*14), '/'); 
header('Location: /'); return;
}

# Количество 24 часа
$times = time() - 60*60*24;
$users_rows = $db->query("SELECT reg FROM `db_users` WHERE `reg` > '$times'")->numRows();
$users24 = $users_rows;

# Статистика
$stats = $db->query("SELECT * FROM db_stats WHERE id = '1'")->fetchArray();
?>

<div class="container-body">
<div class="promo m-2 mb-0" style="min-height: 300px;">
<center class="pt-3">
	<img src="/img/promo.png" alt="air" class="m-2 wow bounceInRight" style="max-width: 30%;">
<h1 class="wow fadeIn" data-wow-delay="0.2s"><b>Экономическая онлайн игра!</b></h1>
<p class="p-2 mb-0 wow fadeIn" data-wow-delay="0.2s">Управляй своим авиапарком благодаря нашей игре, зарабатывай играя в игру!<br/>
Получи подарок за регистрацию <b style="color: #fc3;">"Самолет URAL AIRLINES"</b> БЕСПЛАТНО!<br>
Пока самолеты бороздят воздушное пространство,<br> прибыль от их полетов регулярно прилетает Вам на кошелек.</p>

<a href="/reg" class="btn btn-lg wow bounce" target="_blank"><i class="fa fa-plane"></i> Начать играть</a><br/><br/>
</center>

</div>

<div class="stats p-3">
<div class="row text-center text-uppercase">

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st1.png"></div>
			<h3><?=$stats['users'];?> <sup style="color: #3f4;" title="Регистраций за 24 часа">+<?=$users24;?></sup></h3>
		</center>
		</div>
		<div class="stat-title">Пользователей
		</div>
	</div>
</div>

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st3.png"></div>
			<h3><?=$stats['inserts'];?> <small>руб.</small></h3>
		</center>
		</div>
		<div class="stat-title">Пополнено
		</div>
	</div>
</div>

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st4.png"></div>
			<h3><?=$stats['payments'];?> <small>руб.</small></h3>
		</center>
		</div>
		<div class="stat-title">Выплачено
		</div>
	</div>
</div>

<div class="col-md-6 col-lg-3 p-2">
	<div class="stat-block">
		<div class="stat-info">
		<center>
			<div class="stat-img"><img src="/img/st2.png"></div>
			<h3><?=intval(((time() - $config->start_time) / 86400 ) +1); ?></h3>
		</center>
		</div>
		<div class="stat-title">Работает дней
		</div>
	</div>
</div>


</div>
</div>

</div>






<center>
	<h3 class="text-center text-uppercase wrapper-title shadow-sm"><b><?=$config->sitename; ?></b></h3>
</center>


<div class="container-body mt-2">
<div class="wrapper">

<div class="row">
<div class="col-lg-4 col-md-4 text-center p-1">
<div class="about-img wow fadeIn" style="display: block;opacity; 0.8;margin-top: -75px;margin-left: -30px;height: 145%; width: 125%;">
</div>
</div>
<div class="col-lg-8 col-md-8">
<div class="about p-2">
<p style="font-size: 115%;font-weight: 500; opacity: 0.9;">
Экономическая онлайн игра с выводом денег, управляй своим авиапарком в нашей игре.
Вам необходимо лишь <a href="/reg">зарегистрироваться</a> в игре, и получить  ПОДАРОК самолет URAL AIRLINES!
Самолёт начнет приносить Вам прибыль сразу как только зайдёте в свой аккаунт, круглосуточно и без выходных!
А чтобы увеличить авипарк, докупайте самолёты разного уровня, доступно 9 разновидностей самолётов с разным характеристиками, чем дороже самолет тем больше процент заработок в месяц. Ограничений на кличество самолётов нет. Вы сами решаете, сколько будете зарабатывать!
</p>
<p style="font-size: 100%;opacity: 0.9;">
Продуманная экономика, нет лимитов, баллов и кеш-поинтов, выгодная реферальная программа за каждого реферала будете получать пассивный доход, гарантия платежеспособности и массой других преимуществ. Мы делаем все, чтобы Ваше пребывание на нашем сайте было максимально комфортным!
Играя с удовольствием, Вы можете зарабатывать еще больше.</p>
</div>
</div>
</div>

</div>


<br/>
<div class="row m-0 text-center" style="text-transform: uppercase;text-shadow: 0 1px 3px rgba(25,25,25,0.3);">
<div class="col-lg-4 p-3 wow fadeIn" data-wow-delay="0.4s"><br/><br/>
<h4 class="p-2 mb-0 shadow stat-block text-light">
<center style="position: relative;">
<span style="position: absolute;top: -15px;left:10px;color: rgba(115,165,255,0.4);font-size: 400%;"><i><b>1</b></i></span>
<img src="/img/a1.png" style="width: 110px;margin-top: -65px !important;border: 4px solid rgba(25, 25, 25, 0.3);border-radius: 3em;"></center>
<b><span style="color: #fc5 !important;">Купите</span><br/>самолеты</b></h4>
</div>

<div class="col-lg-4 pt-3 wow fadeIn" data-wow-delay="0.5s"><br/><br/>
<h4 class="p-2 mb-0 shadow stat-block text-light">
<center style="position: relative;">
<span style="position: absolute;top: -15px;left:10px;color: rgba(115,165,255,0.4);font-size: 400%;"><i><b>2</b></i></span>
<img src="/img/a2.png" style="width: 110px;margin-top: -65px !important;border: 4px solid rgba(25, 25, 25, 0.3);border-radius: 3em;"></center>
<b><span style="color: #fc5 !important;">получайте</span><br/>доход</b></h4>
</div>

<div class="col-lg-4 pt-3 wow fadeIn" data-wow-delay="0.6s"><br/><br/>
<h4 class="p-2 mb-0 shadow stat-block text-light">
<center style="position: relative;">
<span style="position: absolute;top: -15px;left:10px;color: rgba(115,165,255,0.4);font-size: 400%;"><i><b>3</b></i></span>
<img src="/img/a3.png" style="width: 110px;margin-top: -65px !important;border: 4px solid rgba(25, 25, 25, 0.3);border-radius: 3em; "></center>
<b><span style="color: #fc5 !important;">Выводите</span><br/>деньги</b></h4>
</div>

</div>




<?
$news = $db->query('SELECT * FROM `db_news` ORDER BY `id` DESC LIMIT 1')->fetchAll();
foreach ($news as $news) { 
?>
<div class="container">
    
<center><h3 class="text-center text-uppercase wrapper-title shadow-sm"><b><?=$news['title']; ?></b></h3></center>
<div class="wrapper mt-2 pb-2">
    
<div class="row">
<div class="col-md-2 text-center"><img src="<?=$news['img']; ?>" alt="#<?=$news['id']; ?>" class="rounded img-thumbnail img-responsive m-1" style="width: 256px;">
<br/>
<span class="badge badge-success">Дата публикации: <br/><b><?=date("d.m.Y в H:i",$news['add']); ?></b></span></div>
<div class="col-md-10">
<div class="about p-2 pb-0 text-center">
<p style="font-size: 115%;font-weight: 500; opacity: 0.9;margin-bottom: 0;padding-bottom:0;">
<?=$news['text']; ?></p><hr class="my-1"></div>
</div>
</div></div>
</div>
<?php
	}
?>


<div class="container-body mt-3">
<center>
<h3 class="title"><b>НАШЕ ПРЕДЛОЖЕНИЕ</b></h3>
<p style="font-size: 110%;"><b>ВСЁ САМОЕ ЛУЧШЕЕ ДЛЯ НАШИХ ПОЛЬЗОВАТЕЛЕЙ, С ГАРАНТИЕЙ НАДЁЖНОСТИ!</b></p>
</center>
<div class="container">
<div class="row m-2 about-info" wow fadeIn" data-wow-delay="0.4s">


	<!-- Grid column -->
	<div class="col-md-4 wow bounceInLeft">

                        <div class="row pb-2">
                            <div class="col-12 text-center">  
				<i class="fa fa-home"></i>
                                <p>Ваш авиапарк будет приносить заработок 29% - 45% в месяц стабильно! И ЭТО НЕ ПРЕДЕЛ!</p>
                            </div>
                        </div>

                        <div class="row pb-2">
                            <div class="col-12 text-center">
				<i class="fa fa-gift"></i>
                                <p>За регистрацию самолет "URAL AIRLINES" в подарок! Множество бонусов ждет каждого внутри игры.</p>
                            </div>
                        </div>

                        <div class="row pb-2">
                            <div class="col-12 text-center">
				<i class="fa fa-link"></i>
                                <p>Вы можете зарабатывать прoсмaтривaя ccылки, а также рекламировать свои ccылки.</p>
                            </div>
                        </div>

	</div>
	<!-- Grid column -->


	<!-- Grid column -->
	<div class="col-md-4 about-img2 wow bounceInUp"></div>
	<!-- Grid column -->


	<!-- Grid column -->
	<div class="col-md-4  wow bounceInRight">

                        <div class="row pb-2">
                            <div class="col-12 text-center"><i class="fa fa-users"></i>
                                <p>Партнерская программа<br>5%-2%-1% от пополнений вашими рефералами на счет для вывода.</p>
                            </div>
                        </div>

                        <div class="row pb-2">
                            <div class="col-12 text-center">
				<i class="fa fa-ruble-sign"></i>
                                <p>На нашем проекте можно выводить на платежные системы Payeer, Qiwi, Яндекс и множество других.</p>
                           </div>
			</div>

                        <div class="row pb-2">
                            <div class="col-12 text-center"><i class="fa fa-umbrella"></i>
                                <p>У нас нет ограничений на вывод, выводи сколько заработал! БАЛЛОВ НЕТ и КЕШ-ПОИНТОВ.</p>
                            </div>
                        </div>

	</div>
	<!-- Grid column -->
</div>
</div>

</div>


<div class="container-body mt-3">
<center><h3 class="text-center text-uppercase wrapper-title shadow-sm"><b>МАРКЕТИНГ ИГРЫ</b></h3></center>
<div class="wrapper" style="background: rgba(35,45,55,0.3) !important;">
<center class="wow fadeIn">
<p class="text-white">ПРОДУМАННЫЙ МАРКЕТИНГ НАШЕЙ ИГРЫ ПОЗВОЛЯЕТ СТАБИЛЬНО ПОЛУЧАТЬ ДОХОД</p>
</center>
<div class="m-2 row text-uppercase wow bounceInUp">
<?PHP
$shop = $db->query("SELECT * FROM db_tarif")->fetchAll();

	foreach($shop as $shop){
$month = sprintf("%.0f",($shop['speed']*100)/$shop['price']*24*30);
$profit_trf = sprintf("%.0f",($shop['speed']*100)/$shop['price']*24*$shop['period']);
?>
<div class="col-md-4 p-1" style="font-size: 120%;">
<div class="card trf-home m-0 text-uppercase">
<center>
<div class="trf-img" style="background: #23a5f5 url(/img/items/<?=$shop['img']; ?>.png) no-repeat center center;" alt="shop">
	<span><?=$shop['img']; ?></span>
</div>
 <h4 class="card-title mb-0">
<b><?=$shop['title']; ?></b>
</h4>
</center>

<div class="p-2">
<center>
<div class="trf-text">
<small>Доход в день</small> <br/>
<b><?=$shop['speed']*24; ?> <small>РУБ.</small></b>
</div>
<div class="trf-text mt-1">
<small>Доход в месяц</small> <br/>
<b><?=$shop['speed']*24*30; ?> <small>РУБ.</small> / <?=$month; ?>%</b>
</div>
<span class="badge p-2 m-2 btn-warning">Цена <b><?=$shop['price']; ?> руб.</b></span>
</center>
 </div>

</div>
</div>
<?PHP
	}
?>
</div>
</div>

<center>
<h3 class="title"><b>КРАТКАЯ СТАТИСТИКА</b></h3>
<p style="font-size: 110%;"><b>БОЛЕЕ ПОДРОБНАЯ ИНФОРМАЦИЯ НА СТРАНИЦЕ <a href="/stats" class="text-warning">СТАТИСТИКА!</a></b></p>
</center>

<div class="row table-st m-2">
<div class="col-md-6">
<div class="card">
<h5 class="card-header">Последние 10 пополнений:</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Сумма</td>
		<td>Время</td>
	</thead>
<?php
$inserts = $db->query('SELECT * FROM db_insert WHERE status = 1  ORDER BY id DESC LIMIT 10')->fetchAll();
foreach ($inserts as $inserts) {
		?>
		<tr>
			<td><i class="fa fa-user"></i> <?=$inserts['login']; ?></td>
			<td><?= sprintf("%.2f",$inserts['sum']); ?> руб.</td>
			<td><?=date("d/m/Y в H:i",$inserts['add']); ?> <i class="fa fa-clock-io"></i></td>
  		</tr>
		<?php
	}
  ?>
</table>
</div>
</div>

<div class="col-md-6">
<div class="card">
<h5 class="card-header">Последние 10 выплат:</h5>
<table class="table table-sm text-center">
	<thead>
		<td>Логин</td>
		<td>Сумма</td>
		<td>Время</td>
	</thead>
<?php
$payout = $db->query('SELECT * FROM db_payout WHERE status = 3  ORDER BY id DESC LIMIT 10')->fetchAll();
foreach ($payout as $payout) {
		?>
		<tr>
			<td><i class="fa fa-user"></i> <?=$payout['login']; ?></td>
			<td><?= sprintf("%.2f",$payout['sum']); ?> руб.</td>
			<td><?=date("d/m/Y в H:i",$payout['add']); ?> <i class="fa fa-clock-io"></i></td>
  		</tr>
		<?php
	}
  ?>
</table>
</div>
</div>
</div>

</div>
