// TODO If your question type requires some Javascript, you can put it in this file.
// If not, you should delete this file.
document.addEventListener('DOMContentLoaded', function(){

	var add_parametro = document.getElementById('id_add_parametro');
	window.contador_campos = 0;
	add_parametro.addEventListener( 'click', function(){
		contador_campos++;

		document.getElementsByClassName("linha-parametro")[contador_campos - 1].style.display = "block";
	}, true );

	var inputs = document.getElementsByClassName("parametro-adicional");

	for (var j = 0; j < inputs.length; j++) {
		var input = inputs[j];

		console.log(input.value.length, input.parentNode.parentNode);

		if (input.value.length) {
			contador_campos++;
			input.parentNode.parentNode.parentNode.parentNode.style.display = "block";
		}
	}

	var botoes = document.getElementsByClassName("btn-deletar");

	for (var i = 0; i < botoes.length; i++) {
		var botao = botoes[i];

		(function(botao) {
			botao.addEventListener( 'click', function(e){
				e.preventDefault();

				contador_campos--;

				var id = "id_param-" + (botao.id.split("-")[1]);
				document.getElementById(id).value = "";
				
				botao.parentNode.parentNode.style.display = "none";
				return false;
			}, true );
		})(botao);
	};

}, false);
