<?php
	// $titulo = "Ofertas e Lançamentos";
	// $conteudo = $Anuncios->exibir("pagina_principal");
	// $corConteudo = "#FFFFFF";
	// $ocultarBarraNavegacao = 1;
	$conteudo = '
		<table id="tabelaPrincipalEscolha">
			<tr align="center">
				<td>
					<div id="boxPrincipalEscolha">
						<div id="selecaoCampeoes">
							';
							for($i=1;$i<=5;$i++){
								switch($i){
									case 1:
										$role = "top";
										break;
									case 2:
										$role = "jungle";
										break;
									case 3:
										$role = "mid";
										break;
									case 4:
										$role = "sup";
										break;
									case 5:
										$role = "adc";
										break;
								}
								$conteudo .= '
									<div class="boxCampeao '.$role.'">
										<div class="imagemCampeao">
											<img src="imagens/campeoes/Aatrox_Square_0.png">
										</div>
										<span class="nomeJogador">Jogador '.$i.'</span>
									</div>
								';
							}
							$conteudo .= '
						</div>
						<div id="mapa">
							<div class="miniaturaCampeao top"></div>
							<div class="miniaturaCampeao jungle"></div>
							<div class="miniaturaCampeao mid"></div>
							<div class="miniaturaCampeao sup"></div>
							<div class="miniaturaCampeao adc"></div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	';
?>