<?php

if( !session_id() ) @session_start();

require '../vendor/autoload.php';

use Aura\SqlQuery\QueryFactory;
use Delight\Auth\Auth;
use DI\ContainerBuilder;
use League\Plates\Engine;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    Engine::class => function() {
        return new Engine('../app/views');
    },

    QueryFactory::class => function() {
        return new QueryFactory('mysql');
    },

    PDO::class => function() {
        $driver = "mysql";
        $host = "localhost";
        $database_name = "macro_test";
        $charset = "utf8";
        $username = "root";
        $password = "";

        return new PDO("$driver:host=$host;dbname=$database_name;charset=$charset", $username, $password);
    },
]);
$container = $containerBuilder->build();

$templates = new League\Plates\Engine('../app/views');

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/main-page', ['App\controller\MessageController', 'mainPage']);

    $r->addRoute('GET', '/replace-words', ['App\controller\MessageController', 'replaceWordsPage']);
    $r->addRoute('POST', '/replace-words', ['App\controller\MessageController', 'replaceWordsChange']);

    $r->addRoute('GET', '/remove-words', ['App\controller\MessageController', 'removeWordsPage']);
    $r->addRoute('POST', '/remove-words', ['App\controller\MessageController', 'removeWordsChange']);

    $r->addRoute('GET', '/topics', ['App\controller\TopicController', 'index']);

    $r->addRoute('GET', '/topic-create', ['App\controller\TopicController', 'create']);
    $r->addRoute('POST', '/topic-create', ['App\controller\TopicController', 'store']);

    $r->addRoute('GET', '/topic-edit/{id:\d+}', ['App\controller\TopicController', 'edit']);
    $r->addRoute('POST', '/topic-edit', ['App\controller\TopicController', 'update']);

    $r->addRoute('GET', '/topic-delete/{id:\d+}', ['App\controller\TopicController', 'delete']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo $templates->render('error/404');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo $templates->render('error/405');
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $container->call($handler, [$vars]);

        break;
}
