// TODO If your question type requires some Javascript, you can put it in this file.
// If not, you should delete this file.
document.addEventListener('DOMContentLoaded', function(){

	var add_parametro = document.getElementById('id_add_parametro');
	window.contador_campos = 0;
	add_parametro.addEventListener( 'click', function(){
		contador_campos++;
		var parametros_adicionais = document.getElementById('parametros-adicionais');
		var div = document.createElement("div");

		var label = document.createElement("label");
		var t = document.createTextNode("Parâmetro adicional "+contador_campos );
		label.appendChild(t);

		parametros_adicionais.appendChild(div);
		var inp = document.createElement("input");
		inp.name = "parametros_adicionais[]";
		div.appendChild(label);
		div.appendChild(inp);

		var btn = document.createElement("button");
		var t = document.createTextNode("Deletar");
		btn.appendChild(t);
		div.appendChild(btn);

		btn.addEventListener('click',function(){
			var pai = btn.parentNode;
			pai.parentNode.removeChild(pai);

		},true)

	}, true );
}, false);
