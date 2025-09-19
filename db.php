<?php


//estamos fazendo essa verificaçõe para que não seja executado a criação da tabela do banco de dados pelo navegador, somente via CMD
if (PHP_SAPI != 'cli') {
   exit('Rodar via CLI');
}
// __DIR__ é uma constante magica utilizada para recuperar o caminho completo da pasta que está sendo executado
require __DIR__ . '/vendor/autoload.php';




// importando os dados do arquivo settings.php e passando para a variavel $settings
$settings = require __DIR__ . '/src/settings.php';
// Instanciando  app
$app = new \Slim\App($settings);


// importando os dados do arquivo dependencies.php pois dentro do mesmo contém o nosso container com a injeção de dependecia em db
require __DIR__ . '/src/dependencies.php';


$db = $container->get('db');


$schema = $db->schema();
$tabela = 'produtos';


$schema->dropIfExists( $tabela );


//cria a tabela produtos
$schema->create($tabela, function($table){
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->timestamps();
   


});


//Insert de teste


$db->table($tabela)->insert([
    'titulo' => 'Smartphone Motorola Moto G6 32GB Dual Chip',
    'descricao' => 'Android Oreo - 8.0 Tela 5.7" Octa-Core 1.8 GHZ 4G Câmera 12 + 5MP (Dual Traseira) - Índigo',
    'preco' =>  899.00,
    'fabricante' => 'Motorola',
    'created_at' => '2019-10-22',
    'updated_at' => '2019-10-22'
]);


$db->table($tabela)->insert([
    'titulo' => 'Iphone X Cinza Espacial 64GB',
    'descricao' => 'Tela 5.8" IOS 12 4G WI-FI Câmera 12MP - Apple',
    'preco' => 4999.00,
    'fabricante' => 'Apple',
    'created_at' => '2020-01-10',
    'updated_at' => '2020-01-10'
]);


?>
