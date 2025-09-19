<?php
// ============================
// Configuração do DIC (Dependency Injection Container) do Slim 3
// O "container" guarda e fornece serviços (renderer, logger, db, etc.) sob demanda.
// ============================


// Importa o gerenciador do Eloquent fora do Laravel (Capsule)
use Illuminate\Database\Capsule\Manager as Capsule;


// Obtém a instância do container a partir do app Slim
$container = $app->getContainer();




// ============================
// Serviço: view renderer (Slim\Views\PhpRenderer)
// Renderiza arquivos .php como views
// ============================
$container['renderer'] = function ($c) {
    // Lê do container->settings as configurações do renderer (por ex.: caminho das views)
    $settings = $c->get('settings')['renderer'];


    // Cria e retorna a instância do renderer apontando para a pasta de templates
    return new Slim\Views\PhpRenderer($settings['template_path']);
};




// ============================
// Serviço: logger (Monolog)
// Fornece logging estruturado com handlers e processors
// ============================
$container['logger'] = function ($c) {
    // Busca configurações do logger (nome, caminho do arquivo, nível de log) em settings
    $settings = $c->get('settings')['logger'];


    // Cria um logger com o nome configurado (aparece nos registros)
    $logger = new Monolog\Logger($settings['name']);


    // Adiciona um processor que injeta um UID único em cada registro de log (facilita rastreamento)
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());


    // Adiciona um handler que grava os logs em arquivo no caminho/nível configurados
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));


    // Retorna o logger pronto para uso via $this->logger nas rotas/controladores
    return $logger;
};




// ============================
// Serviço: db (Eloquent ORM via Capsule)
// Prepara a conexão e inicializa o Eloquent
// ============================
$container['db'] = function($c){


    // Cria uma nova instância do gerenciador do Eloquent (Capsule)
    $capsule = new Capsule;


    // Adiciona a conexão usando as credenciais do settings['db']
    // (driver, host, database, username, password, charset, collation, prefix, etc.)
    $capsule->addConnection($c->get('settings')['db']);


    // Torna a instância global (Capsule::connection() disponível globalmente, caso necessário)
    $capsule->setAsGlobal();


    // Inicializa o Eloquent ORM (habilita os modelos Eloquent a usarem essa conexão)
    $capsule->bootEloquent();


    // Retorna o Capsule para ser usado como serviço 'db' no container
    // Ex.: em uma rota, $this->db->table('users')->get();
    return $capsule;
};
