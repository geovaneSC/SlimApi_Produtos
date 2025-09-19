<?php


use Slim\Http\Request;
use Slim\Http\Response;


//O código a seguir deve habilitar o CORS
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});




// estou acessando o arquivo routas e logo em seguida acessando os arquivos autenticacao e produtos esses arquivos são as nossas rotas da nossa api
require __DIR__ . '/routes/autenticacao.php';
require __DIR__ . '/routes/produtos.php';


// Rota abrangente para atender a uma página 404 Não Encontrado se nenhuma das rotas corresponder
// NOTA: certifique-se de que esta rota seja definida por último
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // lidar usando o manipulador padrão de página não encontrada do Slim
    return $handler($req, $res);
});
