<?php
// Importa classes necessárias do Slim e de outros pacotes
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;   // Modelo Produto (não está sendo usado aqui, mas foi importado)
use App\Models\Usuario;   // Modelo Usuario, usado para consultar dados no banco
use \Firebase\JWT\JWT;    // Biblioteca para geração de tokens JWT




// Rota para geração de token (POST /api/token)
$app->group('/api', function(){
    $this->post('/token', function($request, $response){


    // Pega os dados enviados no corpo da requisição (JSON ou formulário)
    $dados = $request->getParsedBody();


    // Extrai email e senha dos dados recebidos
    // Caso não existam, atribui null
    $email = $dados['email'] ?? null;
    $senha = $dados['senha'] ?? null;


    // Busca no banco um usuário com o email informado
    $usuario = Usuario::where('email', $email)->first();


    // Verifica se encontrou o usuário e se a senha enviada confere com a senha salva
    if( !is_null($usuario) && $senha === $usuario->senha){


        // Se usuário e senha forem válidos, gera o token JWT
        // Obtém a chave secreta definida no arquivo de configuração (settings.php)
        $secretKey   = $this->get('settings')['secretKey'];


        // Codifica os dados do usuário no token
        // OBS: aqui está colocando o objeto inteiro, o ideal é apenas dados essenciais (id, email)
        $chaveAcesso = JWT::encode($usuario, $secretKey);


        // Retorna o token em formato JSON
        return $response->withJson([
            'chave' => $chaveAcesso
        ]);


    }

    // Caso o usuário não exista ou a senha esteja incorreta, retorna erro em JSON
    return $response->withJson([
        'status' => 'Erro. Usuario não encontrado'
    ]);


});

$this->post('/usuario/add', function($request, $response){
    $dados = $request->getParsedBody();

   
        //Campo para validações dos dados que iram ser salvou no Banco de dado
       if (empty($dados['nome'])) {
            return $response->withJson([
                'erro' => 'O campo nome é obrigatório'
            ], 400);
        }
       
        if (empty($dados['email'])) {
            return $response->withJson([
                'erro' => 'O campo email é obrigatório'
            ], 400);
        }

        if (empty($dados['senha'])) {
            return $response->withJson([
                'erro' => 'O campo senha é obrigatório'
            ], 400);
        }


        $usuarios = Usuario::create($dados);
        return $response->withJson($usuarios);

});

});

