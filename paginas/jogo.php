<?php
	$pa = str_repeat("&nbsp", 5);
	$pa2 = $pa.$pa;
	$conteudo = '
		Etapas de Jogo<br>
		<br>
		Early Game<br>
		Gank (Jungle)<br>
		'.$pa.'Calcular a quantidade de ganks no período (máximo: 5)<br>
		'.$pa2.'- A chance de gank depende dos valores ofensivos do jungler e defensivos do jogador da lane<br>
		'.$pa2.'- A lane definida é aleatória<br>
		Troca na Lane<br>
		'.$pa.'Força de Solar o cara<br>
		Farm<br>
		'.$pa.'Você leva uma chance maior de kill pro mid game<br>
		'.$pa.'Você leva uma chance maior de defesas pro mid game<br>
	';
	$Jogo->iniciarJogo();
	// $conteudo = '
		// <div style="font-size: 50px; padding: 10px;">
			// Tempo de Jogo: <span id="tempoJogo" data-tempo="0">00:00</span><br>
		// </div>
		// <div style="font-size: 50px; margin: 10px; min-height: 500px; padding: 10px; border: 1px solid black;" id="console"></div>
	// ';
?>