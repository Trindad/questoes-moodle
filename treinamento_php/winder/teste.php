<?php

$temp = 1;
$nome = "joao";

$frase = "meu nome é".$nome;

$frase = "meu nome é {$nome}";

$vetor = array('a','b','c');

var_dump($frase);

function soma($a,$b = 10)
{
	return $a+$b;
}

class Usuario{
	
	private $nome = " ";
	
	public function __construct($name){
		$this->nome = $name."\n";
	}
	
	public function imprimeNome(){
		return $this->nome;
	}
	
	
}

$winder = new Usuario("Winder");
echo $winder->imprimeNome();


