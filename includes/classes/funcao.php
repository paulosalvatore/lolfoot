<?php
	class Funcao {
		public function validarControlador($controlador){
			$arquivo = "controladores/$controlador.php";
			if(!is_file($arquivo)){
				echo"Acesso negado.";
				exit;
			}
			return $arquivo;
		}
		public function checarAjax($script){
			$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
			if(!$isAjax){
				echo"Acesso negado.";
				exit;
			}
		}
	}
?>