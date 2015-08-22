<?php
	class Jogo {
		/*
			Máximo de Pontos
			Top: 170
			Jungle: 200
			Mid: 200
			ADC: 200
			Suporte: 120
		*/
		private $campeoes = array(
			"Lee Sin" => array(
				"jungle" => array(
					"gank" => 50,
					"pressão" => 60,
					"durabilidade" => 50,
					"farm" => 40
				)
			),
			"Cho'Gath" => array(
				"mid" => array(
					"pressão" => 40,
					"durabilidade" => 80,
					"farm" => 80
				)
			),
			"Malphite" => array(
				"top" => array(
					"pressão" => 40,
					"durabilidade" => 70,
					"farm" => 60
				)
			),
			"Janna" => array(
				"suporte" => array(
					"pressão" => 54,
					"durabilidade" => 66,
					"farm" => 0
				)
			),
			"Tristana" => array(
				"adc" => array(
					"pressão" => 58,
					"durabilidade" => 50,
					"farm" => 92
				)
			)
		);
		// private $estrategias = array(
			// "Ataque" => array(
				// "invade" => 3000 // Chance de Invade aumenta em 30%
			// ),
			// "Defesa" => array(
				// "invade" => -3000 // Chance de Invade diminui em 30%
			// )
		// );
		private $chanceGankBase = 3000;
		private $coeficienteGank = 0.37;
		private $coeficienteAbateEarly = 5;
		private $coeficienteAssistenciaEarly = 2;
		private $coeficienteMorteEarly = 6;
		private $coeficienteFarm = 20;
		private $minimoFarmJungler = 30;
		private $chanceAbateSoloMinima = 2000;
		private $chanceAbateSoloBase = 3000;
		private $coeficienteChanceAbateSolo = 0.2;
		public function iniciarJogo(){
			$equipes = array(
				array(
					array(
						"jogador" => "Jorge",
						"pontos" => 50,
						"campeao" => "Malphite",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Maradona",
						"pontos" => 50,
						"campeao" => "Lee Sin",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Carlos",
						"pontos" => 50,
						"campeao" => "Cho'Gath",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Chaves",
						"pontos" => 50,
						"campeao" => "Tristana",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Ramon",
						"pontos" => 50,
						"campeao" => "Janna",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					)
				),
				array(
					array(
						"jogador" => "Eusébio",
						"pontos" => 50,
						"campeao" => "Malphite",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Urnas",
						"pontos" => 50,
						"campeao" => "Lee Sin",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Cortez",
						"pontos" => 50,
						"campeao" => "Cho'Gath",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Hulio",
						"pontos" => 50,
						"campeao" => "Tristana",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					),
					array(
						"jogador" => "Albino",
						"pontos" => 50,
						"campeao" => "Janna",
						"score" => array(
							"abates" => 0,
							"mortes" => 0,
							"assistencias" => 0,
							"farm" => 0
						),
						"early" => array(
							"pontosAbates" => 0,
							"pontosFarm" => 0
						)
					)
				)
			);

			// Early Game
			// Calculo de eventos do early game
			// Restrições
			// Os eventos devem acontecer entre 2:00 e 10:00
			// Cada jogador só pode receber um evento durante um intervalo de 1:36

			// Primeiro evento a ser calculado: GANKS DO JUNGLER
			// O sistema deve pegar a força de gank de um jungler
			// A cada 20 pontos, o jungler tem chance de gankar uma vez
			// Após definir o número de ganks, iremos verificar a chance de cada um dar certo
			// Realizar um comando para pegar uma das lanes aleatoriamente
			// Realizar uma conta que considera valores do jungler e da lane
			// Utiliza os valores de 'pressão' do jungler
			// e os valores de 'pressão' e 'durabilidade' de ambos os jogadores da lane
			// A chance base de um gank dar certo é 10.00%
			// A chance máxima de um gank der certo é 90.00% (ainda não será implementado)
			// Cada ponto de 'pressão' do jungler aumenta em 0.37% a chance do gank dar certo
			// Cada ponto de 'pressão' do(s) aliado(s) na lane aumenta em 0.37% a chance do gank dar certo
			// Cada ponto de 'durabilidade' do inimigo na lane diminui em 0.37% a chance do gank dar certo
			$etapa = "early";
			switch($etapa){
				case "early":
					$horarioBase = 120;
					$horarioEtapa = 96;
					$progressoEarly = array();
					for($i=0;$i<2;$i++){
						$early = array();
						for($a=0;$a<5;$a++){
							$early[$a] = array();
							for($b=0;$b<5;$b++){
								$early[$a][$b] = false;
							}
						}
						$progressoEarly[$i] = array();
						if($i == 0){
							$chaveAliado = 0;
							$chaveOponente = 1;
						}
						else{
							$chaveAliado = 1;
							$chaveOponente = 0;
						}
						$aliado = $equipes[$chaveAliado];
						$oponente = $equipes[$chaveOponente];

						// Calcular Resultados dos Ganks
						$jungler = $aliado[1]["campeao"];
						$forcaJungler = $this->pegarForcaJungler($jungler);
						$numeroGank = $this->pegarNumeroGank($forcaJungler);
						for($j=0;$j<$numeroGank;$j++){
							$posicao = false;
							while(!$posicao){
								$posicao = rand(0, 4);
								if($posicao == 1)
									$posicao = false;
							}
							$chanceGank = $this->pegarChanceGank($forcaJungler, $posicao, $aliado, $oponente);
							if(rand(0, 10000) <= $chanceGank){
								// Gank bem sucedido na posição
								// Pegar um evento disponível no early
								$eventoEncontrado = false;
								while(!$eventoEncontrado){
									$procurarEvento = rand(0, 4);
									if(!$early[$posicao][$procurarEvento]){
										if(rand(0, 1) == 1){
											$matou = "jungler";
											$abate = 1;
											$assistencia = $posicao;
										}
										else{
											$matou = $this->pegarNomePosicao($posicao);
											$abate = $posicao;
											$assistencia = 1;
										}
										$equipes[$chaveAliado][$abate]["score"]["abates"] = $equipes[$chaveAliado][$abate]["score"]["abates"] + 1;
										$equipes[$chaveAliado][$assistencia]["score"]["assistencias"] = $equipes[$chaveAliado][$assistencia]["score"]["assistencias"] + 1;
										$equipes[$chaveAliado][$abate]["early"]["pontosAbates"] = $equipes[$chaveAliado][$abate]["early"]["pontosAbates"] + $this->coeficienteAbateEarly;
										$equipes[$chaveAliado][$assistencia]["early"]["pontosAbates"] = $equipes[$chaveAliado][$assistencia]["early"]["pontosAbates"] + $this->coeficienteAssistenciaEarly;
										if(in_array($abate, array(3, 4))){
											$assistencia2 = ($abate == 3 ? 4 : 3);
											$equipes[$chaveAliado][$assistencia2]["score"]["assistencias"] = $equipes[$chaveAliado][$assistencia2]["score"]["assistencias"] + 1;
											$equipes[$chaveAliado][$assistencia2]["early"]["pontosAbates"] = $equipes[$chaveAliado][$assistencia2]["early"]["pontosAbates"] + $this->coeficienteAssistenciaEarly;
										}
										elseif(in_array($assistencia, array(3, 4))){
											$assistencia2 = ($assistencia == 3 ? 4 : 3);
											$equipes[$chaveAliado][$assistencia2]["score"]["assistencias"] = $equipes[$chaveAliado][$assistencia2]["score"]["assistencias"] + 1;
											$equipes[$chaveAliado][$assistencia2]["early"]["pontosAbates"] = $equipes[$chaveAliado][$assistencia2]["early"]["pontosAbates"] + $this->coeficienteAssistenciaEarly;
										}
										$equipes[$chaveOponente][$posicao]["score"]["mortes"] = $equipes[$chaveOponente][$posicao]["score"]["mortes"] + 1;
										$equipes[$chaveOponente][$posicao]["early"]["pontosFarm"] = $equipes[$chaveOponente][$posicao]["early"]["pontosFarm"] - $this->coeficienteMorteEarly;
										$progressoEarly[$i][] = array(
											"horario" => $horarioBase+$horarioEtapa*$procurarEvento+rand(0, $horarioEtapa),
											"posicao" => $posicao,
											"matou" => $matou,
											"gank" => 1
										);
										$early[$posicao][$procurarEvento] = true;
										$eventoEncontrado = true;
									}
								}
							}
						}

						for($j=0;$j<5;$j++){
							$campeao = $aliado[$j]["campeao"];
							$campeaoInimigo = $oponente[$j]["campeao"];
							
							// Calcular Resultados das Trocas na Lane
							$pressaoAliado = $this->pegarPressaoCampeao($campeao, $j);
							$durabilidadeOponente = $this->pegarDurabilidadeCampeao($campeaoInimigo, $j);
							if($j == 3){
								$suporteAliado = $aliado[4]["campeao"];
								$suporteInimigo = $oponente[4]["campeao"];
								$pressaoAliado += $this->pegarPressaoCampeao($suporteAliado, 4);
								$durabilidadeOponente += $this->pegarDurabilidadeCampeao($suporteInimigo, 4);
							}
							elseif($j == 4){
								$adcAliado = $aliado[3]["campeao"];
								$adcInimigo = $oponente[3]["campeao"];
								$pressaoAliado += $this->pegarPressaoCampeao($adcAliado, 3);
								$durabilidadeOponente += $this->pegarDurabilidadeCampeao($adcInimigo, 3);
							}
							$numeroChancesAbateSolo = $this->pegarNumeroChancesAbateSolo($pressaoAliado, $durabilidadeOponente);
							// Aplicar for usando numeroChancesAbateSolo
							$chanceAbateSolo = $this->pegarChanceAbateSolo($pressaoAliado, $durabilidadeOponente);
							if(rand(0, 10000) <= $chanceAbateSolo){
								$eventoEncontrado = false;
								while(!$eventoEncontrado){
									$procurarEvento = rand(0, 4);
									if(!$early[$j][$procurarEvento]){
										if(in_array($j, array(3, 4))){
											if(rand(1, 10) <= 7){
												$matou = "adc";
												$abate = $j;
												$assistencia = 4;
											}
											else{
												$matou = "suporte";
												$abate = 4;
												$assistencia = $j;
											}
										}
										else{
											$matou = $this->pegarNomePosicao($j);
											$abate = $j;
										}
										$equipes[$chaveAliado][$abate]["score"]["abates"] = $equipes[$chaveAliado][$abate]["score"]["abates"] + 1;
										$equipes[$chaveOponente][$j]["score"]["mortes"] = $equipes[$chaveOponente][$j]["score"]["mortes"] + 1;
										$equipes[$chaveAliado][$abate]["early"]["pontosAbates"] = $equipes[$chaveAliado][$abate]["early"]["pontosAbates"] + $this->coeficienteAbateEarly;
										$equipes[$chaveOponente][$j]["early"]["pontosFarm"] = $equipes[$chaveOponente][$j]["early"]["pontosFarm"] - $this->coeficienteMorteEarly;
										if(in_array($abate, array(3, 4))){
											$assistencia = ($abate == 3 ? 4 : 3);
											$equipes[$chaveAliado][$assistencia]["score"]["assistencias"] = $equipes[$chaveAliado][$assistencia]["score"]["assistencias"] + 1;
											$equipes[$chaveAliado][$assistencia]["early"]["pontosAbates"] = $equipes[$chaveAliado][$assistencia]["early"]["pontosAbates"] + $this->coeficienteAssistenciaEarly;
										}
										$progressoEarly[$i][] = array(
											"horario" => $horarioBase+$horarioEtapa*$procurarEvento+rand(0, $horarioEtapa),
											"posicao" => $j,
											"matou" => $matou,
											"gank" => 0
										);
										$early[$j][$procurarEvento] = true;
										$eventoEncontrado = true;
									}
								}
							}
							
							// Calcular Resultados do Farm
							$farm = $this->pegarFarmCampeao($campeao, $j);
							$min = max(($j == 1 ? $this->minimoFarmJungler : 0), rand($farm, $farm-$this->coeficienteFarm));
							$max = min(100, rand($farm, $farm+$this->coeficienteFarm));
							$qtdeFarm = rand($min, $max);
							$equipes[$chaveAliado][$j]["score"]["farm"] = $qtdeFarm;
							$equipes[$chaveAliado][$j]["early"]["pontosFarm"] = $equipes[$chaveAliado][$j]["early"]["pontosFarm"] + $qtdeFarm;
						}
					}
					// $this->exibirVetor($progressoEarly);
					break;
				case "mid":
					// Cálculos do Mid Game
					// Calcular Pontos Adquiridos no Early
					break;
			}
			$this->exibirVetor($equipes);
		}
		public function exibirVetor($vetor){ // Função apenas para testes
			echo'<pre>';
			print_r($vetor);
			echo'</pre>';
		}
		public function pegarNumeroGank($forcaJungler){
			return floor($forcaJungler/20);
		}
		public function pegarChanceGank($forcaJungler, $posicao, $aliado, $oponente){
			$chanceBase = $this->chanceGankBase;
			$coeficienteGank = $this->coeficienteGank;
			$chanceJungler = $forcaJungler*$coeficienteGank;
			$chanceAliado = $aliado[$posicao]["pressão"]*$coeficienteGank;
			$chanceOponente = $oponente[$posicao]["durabilidade"]*$coeficienteGank;
			return max($chanceBase, floor($chanceBase+$chanceJungler+$chanceAliado-$chanceOponente));
		}
		public function pegarForcaJungler($campeaoNome){
			$informacoesCampeao = $this->pegarInformacoesCampeao($campeaoNome);
			return $informacoesCampeao["jungle"]["gank"];
		}
		public function pegarNumeroChancesAbateSolo($pressaoAliado, $durabilidadeOponente){
			$coeficienteChanceAbateSolo = $this->coeficienteChanceAbateSolo;
			$chanceAliado = $pressaoAliado*$coeficienteChanceAbateSolo;
			$chanceOponente = $durabilidadeOponente*$coeficienteChanceAbateSolo;
			return max(1, min(3, floor($chanceAliado-$chanceOponente)/2));
		}
		public function pegarChanceAbateSolo($pressaoAliado, $durabilidadeOponente){
			$chanceMinima = $this->chanceAbateSoloMinima;
			$chanceBase = $this->chanceAbateSoloBase;
			$coeficienteChanceAbateSolo = $this->coeficienteChanceAbateSolo;
			$chanceAliado = $pressaoAliado*$coeficienteChanceAbateSolo;
			$chanceOponente = $durabilidadeOponente*$coeficienteChanceAbateSolo;
			return max($chanceMinima, floor($chanceBase+$chanceAliado-$chanceOponente));
		}
		public function pegarPressaoCampeao($campeaoNome, $posicao){
			$informacoesCampeao = $this->pegarInformacoesCampeao($campeaoNome);
			$nomePosicao = $this->pegarNomePosicao($posicao);
			return $informacoesCampeao[$nomePosicao]["pressão"];
		}
		public function pegarDurabilidadeCampeao($campeaoNome, $posicao){
			$informacoesCampeao = $this->pegarInformacoesCampeao($campeaoNome);
			$nomePosicao = $this->pegarNomePosicao($posicao);
			return $informacoesCampeao[$nomePosicao]["durabilidade"];
		}
		public function pegarFarmCampeao($campeaoNome, $posicao){
			$informacoesCampeao = $this->pegarInformacoesCampeao($campeaoNome);
			$nomePosicao = $this->pegarNomePosicao($posicao);
			return $informacoesCampeao[$nomePosicao]["farm"];
		}
		public function pegarNomePosicao($posicao){
			switch($posicao){
				case 0:
					$nomePosicao = "top";
					break;
				case 1:
					$nomePosicao = "jungle";
					break;
				case 2:
					$nomePosicao = "mid";
					break;
				case 3:
					$nomePosicao = "adc";
					break;
				case 4:
					$nomePosicao = "suporte";
					break;
			}
			return $nomePosicao;
		}
		public function pegarInformacoesCampeao($campeaoNome){
			return $this->campeoes[$campeaoNome];
		}
		// public function calcularChanceInvade($estrategiaA, $estrategiaB){
			// $chanceInvade = $this->chanceInvadeBase+$this->estrategias[$estrategiaA]["invade"]+$this->estrategias[$estrategiaB]["invade"];
			// return max(0, min(10000, $chanceInvade));
		// }
		// public function calcularChanceAdicionalMatarInvade($time, $inimigo){
			// return min(10000, $this->chanceInvadeBase+(max(0, floor($time["pontos"]-$inimigo["pontos"])/5)*100));
		// }
		// public function calcularInvade($chanceInvade, $timeA, $timeB){
			// $chance = rand(1, 10000);
			// $invade = false;
			// if($chance <= $chanceInvade){
				// $chanceA = $this->calcularChanceAdicionalMatarInvade($timeA, $timeB);
				// $chanceB = $this->calcularChanceAdicionalMatarInvade($timeB, $timeA);
				// $chanceMatarA = rand(1, 10000);
				// $chanceMatarB = rand(1, 10000);
				// $invade = array(
					// "tempo" => array(),
					// "mensagens" => array()
				// );
				// if($chanceA >= $chanceMatarA){
					// $parametrosAbate = array(
						// $timeA[rand(0, 4)]["jogador"],
						// $timeB[rand(0, 4)]["jogador"],
					// );
					// $invade["tempo"][] = rand(30, 90);
					// $invade["mensagens"][] = $this->exibirMensagem("abate", $parametrosAbate);
				// }
				// if($chanceB >= $chanceMatarB){
					// $matou = rand(0, 4);
					// $morreu = rand(0, 4);
					// $timeB[$matou]["pontos"] = $timeB[$matou]["pontos"] + $this->pontosAbate;
					// $parametrosAbate = array(
						// $timeB[$matou]["jogador"],
						// $timeA[$morreu]["jogador"],
					// );
					// $invade["tempo"][] = rand(30, 90);
					// $invade["mensagens"][] = $this->exibirMensagem("abate", $parametrosAbate);
				// }
			// }
			// return $invade;
		// }
		// public function exibirMensagem($tipo, $parametros){
			// $mensagem = "";
			// switch($tipo){
				// case "abate":
					// $mensagem = $parametros[0].' eliminou '.$parametros[1];
					// break;
			// }
			// return $mensagem;
		// }
	}
?>