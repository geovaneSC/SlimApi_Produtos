<?php


// Define o namespace da classe. Isso organiza as classes do projeto e permite o autoloading via PSR-4.
namespace App\Models;


// Importa a classe base Model do Eloquent (ORM do Laravel). Nossa classe Produto vai estender essa classe.
use Illuminate\Database\Eloquent\Model;


// Declara a classe Produto que herda de Model — aqui você ganha métodos como save(), create(), where(), etc.
class Produto extends Model{


    // Para segurança dos dados que irão ser inseridos precisamos criar um atributo protegido
    // que contém um array com os nomes dos atributos que podem ser atribuídos em massa (mass assignment).
    // Isso protege contra atribuições indesejadas quando usar métodos como create() ou fill().
    protected $fillable = [
        'titulo',       // título do produto — campo permitido para mass assignment
        'descricao',    // descrição do produto — campo permitido para mass assignment
        'preco',        // preço do produto — campo permitido para mass assignment (considere usar $casts para float)
        'fabricante',   // fabricante do produto — campo permitido para mass assignment
        'updated_at',   // timestamp de atualização — normalmente gerenciado automaticamente pelo Eloquent
        'created_at'    // timestamp de criação — normalmente gerenciado automaticamente pelo Eloquent
    ];
   
    // Observações rápidas (não parte do código executável):
    // - $fillable evita vulnerabilidades de mass assignment. Alternativa: usar $guarded = [] para bloquear tudo por padrão.
    // - Normalmente não é necessário incluir 'created_at'/'updated_at' em $fillable, pois o Eloquent os gerencia.
    // - Para garantir tipos corretos (ex.: preco como float), use protected $casts = ['preco' => 'float'];
    // - Se a tabela tiver nome diferente do plural padrão, defina: protected $table = 'nome_da_tabela';
    // - Se a chave primária não for 'id', defina: protected $primaryKey = 'nome_chave';
    // - Para esconder campos sensíveis do JSON use: protected $hidden = ['senha'];
}


?>
