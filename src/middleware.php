<?php
// Application middleware


// e.g: $app->add(new \Slim\Csrf\Guard);




//usando um biblioteca jwt para autenticação, criamos um middleware para impossibilitar o acesso de pessoas não logandas nas nossas rotas
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "header" => "X-Token",
    "regexp" => "/(.*)/",
    "path" => "/api", /* or ["/api", "/admin"] */
    "ignore" => ["/api/token"],
    "secret" => $container->get('settings')['secretKey']
]));




/*
Neste middleware estamos enviado esse cabeçarios a cada nova requisição
a ideia é que a cada nova requisição nos iremos configurar a response esse cabeçarios
*/
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
