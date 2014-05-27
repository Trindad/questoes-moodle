<?php

/*executar no terminal : php <nome_do_arquivo>.php*/

$temp = 1;

$nome = "joao";

$frase = "meu nome é".$nome; //concatenação

$frase = "meu nome é {$nome}";

$vetor = array('a','b','c'); //vetor

var_dump($vetor); //imprime o vetor na tela

/**
 * [soma]
 */
function soma($a,$b = 10) //se o usuario informar o valor de $b então $b vale 10.
{
	return $a+$b;
}

/**
 * public -- qualquer codigo tem acesso a variavel ou metodo
 * protected -- só é visivel pela propria classe ou classes filhas
 * private -- 
 */
class Usuario{

	$nome = "";



	public function_construct($nome) {
		$this->nome = $nome;
	}
	public function imprimeNome(){
		return this->nome;
	}
}

class Aluno extends Usuario{

	$var = new Aluno("");
}

$silvana = new Usuario("Silvana");

acho $silvana->imprimeNome();

/**
 * metodos de abrir escopo de HTML
 */

//1º metodo
<?php

?>

<p> ola mundo</p>

<?php

?>

//2º metodo

<?php

$nome = "aaa";

echo "<p>$nome</p>"; 
echo "<p id = \'ab\'></p>"


//3º metodo

echo <<HTML

	<p> 
		<p> ola mundo</p>
	</p>
HTML;

/**
 * php executa o que for passao
 */
eval($codigo);

//titulos para HTML

echo <<HTML
	<h1>XXG</h1>
	<h2>XG</h2>
	<h3>GG</h3>
	<h4>G</h4>
	<h5>M</h5>
	<h6>P</h6>
HTML;


/**
 * Banco de Dados
 */

//buscar todos os dados de uma tabela usuario

select * from usuario where id=3 or nome="A1";

//inserir dados na tabela usuario
insert into usuario (id,nome) values (5,"B1"); 

//atualizar dados com o id = 5 e com o nome 'B3'

update usuario set nome= "B3" where id = 5 limit 1;

//deletar da tabela usaurio onde o id = 5

delete from usuario where id = 5;
