<?php if(!defined('FastCore')){echo ('Выявлена попытка взлома!');exit();}

/**
 * Маршрутизатор (правила маршрутизации страниц).
 */

$GLOBALS['routes'] = array (
'_404' => '../inc/404.php', // 404
'/' => 'home.php', // Главная
'/i/([0-9]+)?' => '/home.php', // Реф-ссылка
'/link/([0-9]+)?' => '/inc/view.php', // Serf
'/stats' => 'stats.php', // Статистика
'/login' => 'login.php', // Вход
'/reg' => 'reg.php', // Регистрация
'/restore' => 'restore.php', // Восстановить пароль
'/news' => 'news.php', // Новости
'/news/i/([^/]+)' => 'news.php', // Вся новость
'/news/p/([0-9]+)?' => 'news.php',
'/reviews' => 'reviews.php', // Отзывы
'/reviews/add' => 'reviews.php', // Отзывы
'/reviews/p/([0-9]+)?' => 'reviews.php',
'/serf' => 'serf.php', // Гостевой серфинг
'/contest' => 'contest.php', // Конкурсы
'/about' => 'about.php', // О проекте
'/terms' => 'terms.php', // Правила
'/help' => 'help.php', // Поддержка
'/video' => 'video.php', // Видео

# Аккаунт
'/user/dashboard' => 'dashboard.php', // Профиль
'/user/bonus' => 'bonus.php', // Бонусы
'/user/bonus2' => 'bonus2.php', // Бонусы 2
'/user/bonus3' => 'bonus3.php', // Бонусы 3
'/user/shop' => 'shop.php', // Персонажи покупка
'/user/store' => 'store.php', // Сбор прибыли
'/user/serf' => 'serf/serf.php', // Серфинг
'/user/serf/add' => 'serf/add.php', // Серфинг добавить
'/user/serf/edit' => 'serf/edit.php', // Серфинг редактирование
'/user/serf/cabinet' => 'serf/cabinet.php', // Серфинг кабинет
'/user/liders' => 'liders.php', // Лучший инвестор
'/user/luckybill' => 'luckybill.php', // Счастливый билет
'/user/jackpot' => 'jackpot.php', // Джекпот
'/user/insert' => 'insert.php', // Пополнить
'/user/insert/payeer' => 'insert.php', // Пополнить payeer
'/user/insert/freekassa' => 'insert.php', // Пополнить freekassa
'/user/payout' => 'pay.php', // Спобом заказа выплаты
'/user/pay/payeer' => 'pay.php', // Выплата payeer
'/user/pay/yandex' => 'pay.php', // Выплата yandex
'/user/pay/qiwi' => 'pay.php', // Выплата qiwi
'/user/exchange' => 'exchange.php', // Обменник
'/user/refs' => 'referals.php', // Рефералы
'/user/settings' => 'settings.php', // Настройки
'/user/success' => 'status_success.php', // Success
'/user/fail' => 'status_fail.php', // Fail
'/user/logout' => 'dashboard.php', // Выход

# Админка
'/'.$adm.'' => 'login.php', // Вход
'/'.$adm.'' => 'main.php', // Главная
'/'.$adm.'/' => 'main.php', // Главная слеш
'/'.$adm.'/config' => 'config.php', // Настройки
'/'.$adm.'/users' => 'users.php', // Пользователи
'/'.$adm.'/users/info/([0-9]+)?' => 'users.php', // Пользователь
'/'.$adm.'/users/p/([0-9]+)?' => 'users.php', // Пользователи страницы
'/'.$adm.'/st/([^/]+)' => 'stats.php', // Статистика
'/'.$adm.'/news' => 'news.php', // Новости
'/'.$adm.'/news/add' => 'news.php', // Новости
'/'.$adm.'/news/edit/([0-9]+)?' => 'news.php', // Новости
'/'.$adm.'/pers' => 'pers.php', // Персонажи
'/'.$adm.'/pers/add' => 'pers.php', // Персонажи
'/'.$adm.'/pers/edit/([0-9]+)?' => 'pers.php', // Персонажи
'/'.$adm.'/contest_ref' => 'contest_refs.php', // Реф-конкурс
'/'.$adm.'/contest_ref/list' => 'contest_refs.php', // Реф-конкурс 
'/'.$adm.'/contest_ref/add' => 'contest_refs.php', // Реф-конкурс 
'/'.$adm.'/contest_inv' => 'contest_inv.php', // Инв-конкурс
'/'.$adm.'/contest_inv/list' => 'contest_inv.php', // Инв-конкурс 
'/'.$adm.'/contest_inv/add' => 'contest_inv.php', // Инв-конкурс 
'/'.$adm.'/feik' => 'feik.php', // Фейки
);
?>