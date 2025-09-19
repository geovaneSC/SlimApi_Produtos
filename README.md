<h2>📖 Introdução</h2>

<p>Este projeto foi desenvolvido com o objetivo de construir uma API RESTful utilizando PHP e o Slim Framework, tendo como principal finalidade o cadastro, gerenciamento e consulta de produtos.</p>

<p>A API segue os princípios do REST e faz uso de práticas modernas como:</p>

<ul>
  <li>Injeção de dependências para manter o código modular e escalável</li>
  <li>Eloquent ORM (via Illuminate) para facilitar a comunicação com o banco de dados de forma orientada a objetos</li>
  <li>JWT (JSON Web Token) para autenticação e segurança no acesso às rotas protegidas</li>
</ul>

<p>Com isso, o sistema possibilita a implementação de operações de CRUD (Create, Read, Update, Delete) para produtos e usuários, servindo como uma base sólida para o aprendizado de APIs em PHP e também como ponto de partida para projetos reais que demandem integração backend.</p>

<hr>
<h2>🔑 Autenticação</h2>

A API utiliza JWT (JSON Web Token) para autenticação.<br>
Endpoint de login: POST /api/token<br><br>
Parâmetros no corpo da requisição (JSON):<br>
{<br>
  "email": "slim.api@gmail.com",<br>
  "senha": "1234578"<br>
}
<br><br>
Resposta de sucesso:<br>
{<br>
  "chave": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MTcsIm5vbWUiOiJwcm9kdXRvIiwiZW1haWwiOiJzbGltLmFwaUBnbWFpbC5jb20iLCJzZW5oYSI6IjEyMzQ1NzgiLCJ1cGRhdGVkX2F0IjoiMjAyNS0wOS0wM1QwNDoxNToxMy4wMDAwMDBaIiwiY3JlYXRlZF9hdCI6IjIwMjUtMDktMDNUMDQ6MTU6MTMuMDAwMDAwWiJ9.c7hO6oGBsWlgWWz6iw_x8rOqIpxjZEuotWCASeGvIZU"<br>
}
<br><br>
Erro:<br>
{<br>
  "status": "Erro. Usuário não encontrado"<br>
}
<br><br>

OBS: O token deve ser enviado no cabeçalho Authorization:<br>
No campo key: X-Token e a chave eyJ0eXAiOiJKV1QiLCJh...<br>

<hr>
<h2>👤 Cadastrar Usuários</h2>

POST  /api/usuario/add<br>
Parâmetros no corpo da requisição (JSON):<br>
{<br>
   “Nome”: produto1<br>
  "email": "slim1.api@gmail.com",<br>
  "senha": "123456789"<br>
}<br><br>
Resposta de sucesso:<br>
{<br>
    "nome": "produto1",<br>
    "email": "slim1.api@gmail.com",<br>
    "senha": "12345789",<br>
    "updated_at": "2025-09-03T04:37:16.000000Z",<br>
    "created_at": "2025-09-03T04:37:16.000000Z",<br>
    "id": 18<br>
}<br><br>
Gerar Token com os novos dados:<br>
Endpoint de login: POST /api/token<br>
Parâmetros no corpo da requisição (JSON):<br>
{<br>
  "email": "slim1.api@gmail.com",<br>
  "senha": "123456789"<br>
}<br><br>
Resposta de sucesso:<br>
{<br>
    "chave": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6MTgsIm5vbWUiOiJwcm9kdXRvMSIsImVtYWlsIjoic2xpbTEuYXBpQGdtYWlsLmNvbSIsInNlbmhhIjoiMTIzNDU3ODkiLCJ1cGRhdGVkX2F0IjoiMjAyNS0wOS0wM1QwNDozNzoxNi4wMDAwMDBaIiwiY3JlYXRlZF9hdCI6IjIwMjUtMDktMDNUMDQ6Mzc6MTYuMDAwMDAwWiJ9.Tul74pgPV7O4l_MEAzD6k4qPLJYyBghLrHkTkzvS11g"<br>
}<br>

<hr>
<h2>🛒 Produtos (API v1)</h2>
<ol>
  <li>Listar produtos – GET /api/v1/produtos/lista</li>
  <li>Criar produto – POST /api/v1/produtos/adiciona</li>
  <p>
    Os campos que precisam ser passados:<br>
    titulo, descricao,preco, fabricante
  </p>
  <li>Buscar produto por ID – GET /api/v1/produtos/lista/{id}</li>
  <li>Atualizar produto – PUT /api/v1/produtos/atualiza/{id}</li>
  <li>Remover produto – DELETE /api/v1/produtos/remove/{id}</li>
</ol>
<hr>
<h2>⚠️ Códigos de Resposta</h2>
200 OK – Requisição bem-sucedida<br>
201 Created – Recurso criado com sucesso<br>
400 Bad Request – Erro de validação nos dados enviados<br>
401 Unauthorized – Token inválido ou ausente<br>
404 Not Found – Recurso não encontrado<br>
500 Internal Server Error – Erro inesperado no servidor<br>
<hr>
<h2>📌 Observações</h2>
<ul>
  <li>Todas as requisições e respostas usam JSON.</li>
  <li>Necessário autenticação via JWT em rotas protegidas (/api/v1/produtos/*).</li>
  <li>Utilize ferramentas como Postman ou Insomnia para testes.</li>
</ul>
