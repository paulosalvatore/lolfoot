<?php
	class Estrutura {
		private $diretorioPaginas = "paginas/";
		private $arquivoNaoEncontrado = "naoEncontrado";
		public function exibirPagina($pagina){
			$arquivo = $this->diretorioPaginas.(is_file($this->diretorioPaginas.$pagina.".php") ? $pagina : $this->arquivoNaoEncontrado).".php";
			include("includes/incluirArquivos.php");
			include("includes/iniciarClasses.php");
			include($arquivo);
			$conteudoPagina = "";
			if(!empty($conteudo))
				$conteudoPagina .= '
					<div class="conteudoPagina"'.($corConteudo ? ' style="background-color: '.$corConteudo.';"' : "").'>
						'.$conteudo.'
					</div>
				';
			if(!empty($incluirConteudo))
				$conteudoPagina .= $incluirConteudo;
			return $conteudoPagina;
		}
	}
?>