Конфигурация сайта: /core/config.php
 - Подключение к БД
 - Путь и данные к админ панели
 - Данные платежей PAYEER и FREE-KASSA
 - Настройки сайта

Подключение платежей:
 - site.ru/payeer.php
 - site.ru/freekassa.php (метод оповещения POST)
 - site.ru/user/success
 - site.ru/user/fail

Панель управления (админка):
Путь до админки меняется в 3х-местах.
 - Директория админки
 - .htaccess которая в админке
и в файле конфигурации /core/config.php там же и логин и пароль

Баннеры в шапке изменяются в файле "head.php" - папка "inc"

php 7.3
http://sotka.ru.com/777admin777   путь к админке . вместо http://sotka.ru.com/  адрес вашего сайта
логин и пароль от нее в папке /core/config.php
