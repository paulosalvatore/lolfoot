<?php
	$progressoJogo = array();

	$eventosFixos = array(
		30 => array(
			"mensagem" => "Seja bem-vindo a Summoners Rift!"
		),
		60 => array(
			"mensagem" => "As tropas serão liberadas em trinta segundos."
		),
		90 => array(
			"mensagem" => "Tropas liberadas!"
		)
	);

	$eventosAleatorios = array(
		"invade" => array(
			"tempoInicial" => 30,
			"chance" => 10
		),
		"gank" => array(
			"tempoInicial" => 180,
			"delay" => 50
		)
	);

	// Invade
	// $invade = $eventosAleatorios["invade"];
	// $chanceInvadeBase = $invade["chance"];
	// $chanceInvade = rand(1, 100);
	// $progressoJogo[1][] = $chanceInvade;
	// if($chanceInvadeBase <= $chanceInvade){
		
		// $progressoJogo[$invade["tempoInicial"]][] = array(
			// "invade" => true,
			// "mortos" => array()
		// );
	// }

	foreach($eventosFixos as $tempo => $evento){
		if($evento["mensagem"])
			$progressoJogo[$tempo][] = $evento;
	}
	echo json_encode($Jogo->iniciarJogo());
	// echo'<pre>';
	// print_r($progressoJogo);
	// echo'</pre>';
	// echo json_encode($progressoJogo);
?>