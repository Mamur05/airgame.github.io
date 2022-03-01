<?php if(!defined('FastCore')){exit('Oops!');}

# Заголовки
$opt = array(
'title' => 'О проекте',
'keywords' => 'скрипт, пчелы, игра, бонусы, серфинги, cars farm car money',
'description' => 'Это экономическая игра, которая позволяет интересно проводить время, и зарабатывать деньги играя в игру.'
);

?>
<div class="container">
<div class="wrapper text-center">
<h4 class="text-uppercase"><b>Экономическая онлайн игра - <?=$config->sitename;?></b></h4><hr>
<p class="p-1" style="font-size: 110%;">Это культовая онлайн игра с экономическим уклоном, которая позволяет не только интересно проводить время, но и стабильно зарабатывать реальные деньги играя в игру. Вливайся в нашу замечательную стратегию игры, и Вы сможете прокачать свои финансы, для этого нужно – покупать самолеты разного уровня, которые будут приносить прибыль. Собирайте её на баланс для вывода и выводите без лимитов и баллов, выплаты автоматические.
<hr>
Также предлагаем выгодную <b>3-x</b> уровневую партнерскую программу <b>5%-2%-1% на вывод</b>, и выгодные <b>бонусы при пополнении до 20%</b>.<br/>
На нашем проекте можно рекламировать свои ссылки, либо смотреть серфинг, получать <b>бонусы каждые 6, 12 и 24 часа</b>, участвовать в конкурсах и в игре <b>Лидер дня</b>. Активация выплат составляет <b>10 руб.</b> <br/>
У нас все функционнирует в автоматическом режиме, как оплата рекламы так и вывод заработанных средств.
Разработкой сайта занималась опытная команда, а это значит, что наш проект работает бесперебойно и доступен всегда! 
Продуманный маркетинг позволяет нам с уверенностью сказать, что проект будет работать <b>БЕЗ РЕСТАРТА</b>!
Также пользователи могут быть уверены в сохранности своих вложений – высокий уровень безопасности позволяет нам это гарантировать.
</p>
</div>
</div>


<center>
	<h3 class="text-center text-uppercase wrapper-title"><b>МАРКЕТИНГ ИГРЫ</b></h3>
</center>
<div class="wrapper" style="background: rgba(35,45,55,0.3) !important;">
<center class="wow fadeIn">
<p class="text-white text-uppercase">ПРОДУМАННЫЙ МАРКЕТИНГ НАШЕЙ ИГРЫ ПОЗВОЛЯЕТ СТАБИЛЬНО ПОЛУЧАТЬ ДОХОД<br/>
В МЕСЯЦ 29 - 45% ЧИСТОЙ ОКУПАЕМОСТИ! БОНУС ЗА РЕГИСТРАЦИЮ САМОЛЕТ URAL AIRLINES!
</p>
</center>
<div class="m-2 row">
<?PHP
$shop = $db->query("SELECT * FROM db_tarif")->fetchAll();

  	foreach($shop as $shop){
$month= sprintf("%.0f",($shop['speed']*100)/$shop['price']*24*30);
?>
<div class="col-lg-4 col-md-6 pb-4">
<div class="card mb-2  trf-home text-uppercase shadow wow fadeIn">

<center>
<div class="trf-img" style="background: #3cf url(/img/items/<?=$shop['img']; ?>.png) no-repeat center center;" alt="shop">
	<span><?=$shop['img']; ?></span>
</div>
</center>

<h4 class="card-title p-1 mb-0 text-center"><b><?=$shop['title']; ?></b></h4>
<div class="list-group m-2 mb-0">

<div class="list-group-item p-1"><small>Скорость:</small> 
<span class="float-right"><b><?=$shop['speed']; ?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i> / час</span>
</div>

<div class="list-group-item p-1"><small>Прибыль в день:</small> 
<span class="float-right"><b><?=$shop['speed']*24; ?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1"><small>Прибыль в месяц:</small> 
<span class="float-right"><b><?=$shop['speed']*24*30; ?></b> <i class="fa fa-ruble-sign" style="font-size: 80%;"></i></span>
</div>

<div class="list-group-item p-1"><small>Окупаемость в месяц:</small> 
<span class="float-right"><b><?=$month; ?>%</b></span>
</div>

<div class="list-group-item p-1"><small>Срок аренды:</small> 
<span class="float-right"><b><?=$shop['period']; ?> дней</b> </span>
</div>

</div>

<center class="p-2">
 <div class="btn btn-danger" type="submit">ЦЕНА <b><?=$shop['price']; ?></b> РУБ.</div>
</center>

 </div>
</div>
	<?PHP
	}
?> 
	</div>

<center class="text-light"><p><hr>
Проект честный и открытый, который поможет Вам приумножить свои средства.<br/>
У нас бесперебойные выплаты и честные условия - присоединяйтесь!. 
</p></center></div>