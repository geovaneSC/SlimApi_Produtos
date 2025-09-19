<?php
// verificação de segurança onde está verificando se o arquivo index.php está rodando em um servidor web
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}
// __DIR__ é uma constante magica utilizada para recuperar o caminho completo da pasta que está sendo executado
require __DIR__ . '/../vendor/autoload.php';
session_start();


// estamos criando uma variavel para guardar o importe da pasta src e o arquivo setting.php
$settings = require __DIR__ . '/../src/settings.php';
// Instanciando o app
$app = new \Slim\App($settings);


// acessando a pasta src e acessando dependencies.php
require __DIR__ . '/../src/dependencies.php';
// acessando a pasta src e acessando middleware.php
require __DIR__ . '/../src/middleware.php';


$container->get('db');// estou inicializando a minha conexão ao banco de dados
// acessando a pasta src e acessando routes.php
require __DIR__ . '/../src/routes.php';
// Run app
$app->run();
