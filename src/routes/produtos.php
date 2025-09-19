<?php


use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;


// Rotas para produtos
/*
Iremos usar um ORM-> Object Relational Mapper  ( Mapeador de objeto relacional)
como estamos usando o Illuminte -> que é um motor de base de dados Laravel sem o laravel
podemos usar o Eloquent ORM que vem junto para que possamos relaciar nossos CRUD e query no banco de dados
de maneira mais simples


A ideia do ORM é trabalhar com orientação a objetos no banco de dados.


*/
$app->group('/api/v1', function(){
   
    //Listar produtos
    $this->get('/produtos/lista', function( $request, $response){
        $produtos = Produto::get();
        return $response->withJson($produtos);


    });
   
    //Adiciona um produto
     $this->post('/produtos/adiciona', function( $request, $response){
        $dados = $request->getParsedBody();


        //Campo para validações dos dados que iram ser salvou no Banco de dado
       if (empty($dados['titulo'])) {
            return $response->withJson([
                'erro' => 'O campo titulo é obrigatório'
            ], 400);
        }


         if (!isset($dados['preco']) || !is_numeric($dados['preco'])) {
            return $response->withJson([
                'erro' => 'O campo preço é obrigatório e deve ser numérico'
            ], 400);
        }


        $produto = Produto::create($dados);
        return $response->withJson($produto);


    });


    //Recupera porduto para um determinado ID
     $this->get('/produtos/lista/{id}', function( $request, $response, $args){
        $produto = Produto::findOrFail($args['id']);//usando o método findOrFail conseguimos selecionar um parametro,no nosso caso vou id
        return $response->withJson($produto);


    });


    //Atualiza produto para um determinado ID
     $this->put('/produtos/atualiza/{id}', function( $request, $response, $args){
       
        $dados = $request->getParsedBody();
        //Campo para validações dos dados que iram ser salvou no Banco de dado
            if (empty($dados['titulo'])) {
                    return $response->withJson([
                        'erro' => 'O campo titulo é obrigatório'
                    ], 400);
                }


                if (!isset($dados['preco']) || !is_numeric($dados['preco'])) {
                    return $response->withJson([
                        'erro' => 'O campo preço é obrigatório e deve ser numérico'
                    ], 400);
                }


        $produto = Produto::findOrFail($args['id']);
        $produto->update($dados);
        return $response->withJson($produto);


    });


    //Remove porduto para um determinado ID
     $this->get('/produtos/remove/{id}', function( $request, $response, $args){
        $produto = Produto::findOrFail($args['id']);//usando o método findOrFail conseguimos selecionar um parametro,no nosso caso vou id
        $produto->delete();
        return $response->withJson($produto);


    });
});
