<?php

/*comentario*/

$temp = 1;

$nome = "joao";

$frase = "Meu nome é".$nome;

$vetor = array('a','b','c');

//var_dump($var);


function soma($a,$b = 10){
	return $a+$b;	
}

class Usuario {
	
	private $nome = " ";
	public function __construct($name){
		$this->nome = $name;
	}
	
	public function imprimeNome(){
		return $this->nome;
	}
}
$test = new Usuario("Andreic");
echo $test-> imprimeNome();
?>


echo <<HTML
	<h1>Título 1</h1>
	<h2>Subtítulo 1</h2>
	<h3>Subtítulo 2</h3>
	<h4>Subtítulo 3</h4>
	<h5>Subtítulo 4</h5>
	<h6>Subtítulo 5</h6>
HTML;


// Banco de Dados

select * from usuario where id=5 or nome="Carlos";

insert into usuario (id,nome) values (10,"Andrei"); 

update usuario set nome= "Carniel" where id = 5 limit 1;

delete from usuario where id = 5;
