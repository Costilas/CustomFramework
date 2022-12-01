<?php

use Classes\App\App;
use Classes\Utility\HttpRequest\Request;
use Classes\Router\Router;

error_reporting(E_ALL);

require_once 'vendor/autoload.php';

/*
 * 1. Перевести данные на env (db и тд)
 * 2. Реализовать DI контейнер
 * 3. Реализовать коллекцию
 * 4. Привести в порядок paginate()
 * 5. Сделать билдер запросов
 * 6. Реализовать raw запросы
 * 7. Релизовать связи в моделях
 * 8. Раскидать PHPDocs аннотации
 * 9. Reddis
 * 10. Db manager - фабрику по драйверам
 * 11. Реализовать миграции
 * 12. Релизовать сидинг
 * 13. Реализовать консольные команды как в артизан
 *
 * */
$app = new App(new Request(), new Router());
$app->init()->run();