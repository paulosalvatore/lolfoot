var tempoAtualizacao = 10;

var eventos = {
	30 : {mensagem : "Seja bem-vindo a Summoners Rift!"},
	60 : {mensagem : "As tropas serão liberadas em trinta segundos."},
	90 : {mensagem : "Tropas liberadas!"}
};
function atualizarCronometro(){
	var tempoJogo = $("#tempoJogo").data("tempo") + 1;
	$("#tempoJogo").data("tempo", tempoJogo);
	var minutos = Math.floor(tempoJogo/60);
	var segundos = tempoJogo%60;
	var exibirTempo = (minutos < 10 ? "0" : "") + minutos + ":" + (segundos < 10 ? "0" : "") + segundos;
	$("#tempoJogo").html(exibirTempo);
	if(eventos[tempoJogo]){
		var evento = eventos[tempoJogo];
		if(evento.mensagem)
			atualizarConsole(evento.mensagem + "<br>");
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
	iniciarJogo();
});