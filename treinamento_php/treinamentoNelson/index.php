<?php

$nome = "Nelson";

$frase = "Meu nome eh". $nome;

echo $frase;


$frase = "Meu nome eh {$nome}";

echo "<br/>";

echo $frase;


echo "<br/>";


$vetor = array('a','b','c');


echo $vetor;


echo "<br/>";


echo "<br/>";


function soma($a, $b = 10) // se o usuario informar o valor de $b vale 10 o valor de $a é opcional
{
	return $a + $b;
}


 echo soma();

// classes


echo "Classes <br/>";

class Usuario{

public function __construct($nome){

	$this->nome = $nome;
	// instancia->atributo->contrutor
}


public function imprimeNome(){
	return $this->nome;
}

}
// criando uma instancia 



//public --> qualquer codigo tem acesso
// protected --> visivel somente p/ classe filha e mae
// private --> visivel somente p/ a propria classe




$mauricio = new Usuario("Mauricio");

echo $mauricio->imprimeNome();


// HTML

$nome = "A";

echo "<p>$nome</p>";

// deixar html formatado de acordo com o que for colocado na linha dentro do echo

echo <<<HTML

<p>1 </p>

UFFS

HTML;


// EXECUTA O CÓDIGO PASSADO EM UMA VARIAVEL 


eval($teste);






























