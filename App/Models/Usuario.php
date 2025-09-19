<?php
namespace App\Models;
// Declara o namespace da classe.
// Namespaces organizam o código e evitam colisão de nomes entre classes.
// Neste caso, a classe ficará em App\Models (padrão em apps Laravel).
use Illuminate\Database\Eloquent\Model;
// Importa a classe base Model do Eloquent (ORM do Laravel).
// Ao estender essa classe, ganhamos funcionalidades de mapeamento objeto-relacional
// como consultas, relacionamentos, timestamps automáticos, etc.
class Usuario extends Model{
 // Declara a classe Usuario que estende (herda) Model.
    // Isso transforma Usuario em um modelo Eloquent, mapeado para uma tabela no DB.
    // Convenção do Eloquent: a tabela esperada é o plural snake_case, ex: 'usuarios'.
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'updated_at',
        'created_at'
    ];
}
?>
