<?php
// Retorna um array de configurações lido pelo app Slim (normalmente incluído como settings.php)
return [
    // Chave principal que agrupa todas as configurações do app
    'settings' => [


        // Mostra detalhes completos de erro (stack trace) nas respostas.
        // IMPORTANTE: deixar true durante desenvolvimento, mas marcar false em produção para não vazar informações sensíveis.
        'displayErrorDetails' => true, // set to false in production


        // Quando true, o Slim adiciona automaticamente o header Content-Length.
        // Aqui está como false para permitir que o servidor web (Apache/Nginx) controle o Content-Length.
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header


        // --- Configurações do renderer (sistema de templates) ---
        'renderer' => [
            // Caminho absoluto para a pasta de templates (views).
            // __DIR__ é o diretório deste arquivo; com '/../templates/' sobe um nível e entra na pasta templates.
            'template_path' => __DIR__ . '/../templates/',
        ],


        // --- Configurações do Monolog (registro de logs) ---
        'logger' => [
            // Nome do canal de log (aparece nas entradas de log)
            'name' => 'slim-app',
            // Caminho do arquivo de log:
            // se a variável de ambiente 'docker' estiver setada, escreve no stdout (útil para containers).
            // caso contrário, grava em ../logs/app.log (arquivo no sistema de arquivos).
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            // Nível mínimo de log que será registrado (DEBUG, INFO, NOTICE, WARNING, ERROR, CRITICAL, ALERT, EMERGENCY)
            'level' => \Monolog\Logger::DEBUG,
        ],


        // --- Configurações do banco de dados (usadas pelo PDO / Eloquent) ---
        'db' => [
            // Tipo de driver (mysql, pgsql, sqlite, etc.)
            'driver' => 'mysql',
            // Host do servidor de banco de dados
            'host' => 'localhost',
            // Nome do banco de dados a ser usado
            'database' => 'slim',
            // Usuário do banco (aqui 'root' — apenas para desenvolvimento)
            'username' => 'root',
            // Senha do usuário do banco (vazia aqui — não recomendado em produção)
            'password' => '',
            // Charset da conexão — importante para codificação correta de caracteres (acentuação)
            'charset' => 'utf8',
            // Collation (regras de comparação/ordenamento de strings)
            'collation' => 'utf8_unicode_ci',
            // Prefixo para nomes de tabelas (útil se quiser prefixar todas as tabelas do app)
            'prefix' => '',
        ],


        // --- Chave secreta usada pelo app (ex.: para assinar JWTs) ---
        // ATENÇÃO: **não é seguro** deixar a secret key fixa no código fonte em produção.
        // Prefira carregar via variável de ambiente ou arquivo .env (ex.: getenv('SECRET_KEY')).
        'secretKey' => '79c597397e5ec79299ee5986a9e3356d9d1a93a4'


    ],
];


