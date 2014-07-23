<?php
 
/*comentario*/

$temp = 1;

$nome = "joao";

$frase = "meu nome é {$nome}";

$vetor = array('a','b','c');

var_dump($frase);

function soma($a,$b){
	return $a+$b;
}
echo soma (2,3) . "\n";

class Usuario {
	private $nome = "";
	public function __construct ($name){
		$this->nome=$name;
	}
	public function imprimeNome() {
		return $this->nome;
	}
}
class Aluno extends Usuario{
	function teste()
	{echo $this->nome;
	
}	
}
$var = new Aluno ("Diego");
echo $var->imprimeNome() . "\n";

$name="Diego";
echo"<p>$name</>";

echo <<HTML
	<p> ola mundo
	  <p> ola mundo</p>
	</p>
	<h1>XXG</h1>
	<h2>XG</h2>
	<h3>GG</h3>
	<h4>G</h4>
	<h5>M</h5>
	<h6>P</h6>
HTML;

eval($codigo);

