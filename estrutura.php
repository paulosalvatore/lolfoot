<?php
	include("includes/incluirArquivos.php");
	$diretorioJSPaginas = "js/paginas/";
	if(is_file($diretorioJSPaginas.$pagina.".js"))
		$incluirArquivos .= '<script type="text/javascript" src="'.$diretorioJSPaginas.$pagina.'.js"></script>';
	echo'
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>LoLFoot</title>
				<link rel="shortcut icon" href="favicon.ico">
				<link rel="stylesheet" type="text/css" href="css/style.css" />
				<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
				<link rel="stylesheet" type="text/css" href="css/jquery-te.css" />
				'.$incluirArquivos.'
			</head>
			<body>
				'.$Estrutura->exibirPagina($pagina).'
			</body>
		</html>
	';
?>