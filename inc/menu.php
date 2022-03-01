<?php

# Начало и конец конкурса
$c_date = date("Ymd",time());
$c_date_begin = strtotime($c_date." 00:00:00");
$c_date_end = strtotime($c_date." 23:59:59");

# Определение платежей за текущий день
$sum_inm = $db->query('SELECT SUM(sum) FROM db_insert WHERE `add` >= '.$c_date_begin.' AND `add` <= '.$c_date_end.' AND status = 1')->fetchAll();
foreach ($sum_inm as $all) {
	$jackpotm = round($all['SUM(sum)']/20,2); // банк 5% от пополнений за текущий день
}



?>


<div class="clearfix"></div>
<div class="clear"></div>
<div class="leftbar"><div class="menubar">
    <div class="menu2 divide text-uppercase">
	<i class="fa fa-bars"></i><span>Игровое меню</span>
    </div>
    <div class="menu__wrapper pt-2">
<center><img src="/img/point.png" style="width: 64px;height: 64px;padding: 7px;border-radius: 3em;border: 3px solid #345;background: #123;"></center>
<h4 class="pt-1 text-center" style="color: #e7e7e7;"> <b><?=$login;?></b> </h4>
        <div class="topbar leftbar__topbar">
            <div class="topbar__bottom">
                <div class="topbar__balance">
                    <p>Баланс для покупок <br/><b><?=$user['money_b'];?></b> <span>руб.</span></p>
		<a class="btn btn-sm btn-success" href="/user/insert"><i class="fa fa-arrow-up"></i><span> <b>Пополнить</b></span></a>
                </div>
                <div class="divide topbar__balance">
                    <p>Баланс для вывода<br/><b><?=$user['money_p'];?></b> <span>руб.</span></p>
		<a class="btn btn-sm btn-danger" href="/user/payout"><i class="fa fa-arrow-down"></i><span> <b>Вывести</b></span></a>
                </div>
            </div>
	</div>

<ul class="leftbar__menu">
		<li><a href="/user/dashboard" style="border: 0 !important;"><i class="fa fa-bars"></i><span>Мой профиль </span> </a></li>
		<li><a  href="/user/liders"><i class="fa fa-star"></i><span>Лидеры дня <font style="color: #fc2;">[<?=$jackpotm; ?> руб.]</font></span></a></li>
		<li><a  href="/user/luckybill"><i class="fa fa-money-bill"></i><span>Счастливый билет  <sup><small class="badge badge-danger">NEW</small></sup></span></a></li>
	
	<li class="menu-title"><span>Авиапарк</span></li>
		<li><a href="/user/shop" style="border: 0 !important;"><i class="fa fa-plane"></i><span>Покупка самолета</span></a></li>
		<li><a href="/user/store"><i class="far fa-money-bill-alt"></i><span>Собрать доход</span></a></li>
	<li class="menu-title"><span>Дополнительно</span></li>
		<li><a href="/user/serf" style="border: 0 !important;"><i class="fa fa-rocket"></i><span>Серфинг сайтов</span></a></li>
		<li><a  href="/user/bonus"><i class="fa fa-gift"></i><span>Ежедневный бонус</span></a></li>
		<li><a  href="/user/bonus2"><i class="fa fa-gift"></i><span>12-часовой бонус</span></a></li>
		<li><a  href="/user/bonus3"><i class="fa fa-gift"></i><span>6-часовой бонус</span></a></li>
		<li><a href="/user/exchange"><i class="fa fa-exchange-alt"></i><span>Обменник</span></a></li>
	<li><a href="/user/refs"><i class="fa fa-users"></i><span>Мои рефералы</span></a></li>
	<li><a href="/user/settings"><i class="fa fa-cog"></i><span>Настройки</span></a></li>
		<li><a href="/user/logout"><i class="fa fa-sign-out-alt"></i><span>Выход</span></a></li>
	</ul>
</div></div></div>