var tempoAtualizacao = 10;

var eventos = {}

function exibirTempo(tempo){
	var minutos = Math.floor(tempo/60);
	var segundos = tempo%60;
	return (minutos < 10 ? "0" : "") + minutos + ":" + (segundos < 10 ? "0" : "") + segundos;
}

function atualizarCronometro(){
	var tempoJogo = $("#tempoJogo").data("tempo") + 1;
	$("#tempoJogo").data("tempo", tempoJogo);
	var mostrarTempo = exibirTempo(tempoJogo);
	$("#tempoJogo").html(mostrarTempo);
	if(eventos[tempoJogo]){
		var evento = eventos[tempoJogo];
		$.each(evento, function(index, value){
				atualizarConsole(mostrarTempo + " - " + index + ".<br>");
		});
	}
	setTimeout(function(){
		atualizarCronometro();
	}, tempoAtualizacao);
}

function atualizarConsole(mensagem){
	$("#console").append(mensagem);
}

function iniciarJogo(){
	atualizarCronometro();
}

$(function(){
	// $.ajax({
		// url: "controladores.php",
		// data:({
			// controlador: "jogo"
		// }),
		// dataType: "json",
		// success: function(result){
			// console.log(result);
			// $.each(result, function(a, b){
				// eventos[a] = {};
				// $.each(b, function(c, d){
					// eventos[a][d] = c;
				// });
			// });
			// iniciarJogo();
		// }
	// }).responseText;
});