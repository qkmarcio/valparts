<?php
	/*
	 * Autor: Maison K. Sakamoto
	 * Revisao: 0
	 * Data: 12/12/2011
	 * 
	 * Arqui principal do sistema, faz chamadas para todas as interfaces
	 */
	
	//Abaixo valicao de acesso do usuario
	session_start('login');
	
	if(!@$_SESSION["conectado"]=='sim'){
		echo "<script language='JavaScript'>
				alert('Voce nao esta conectado, Favor logar novamente.');
 				window.location = '../index.php';
 			  </script>";
	  	echo "string";
		break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Sistemas BTR - Transportes</title><link rel="stylesheet" href="../css/screen.css" type="text/css" media="screen" title="default" /></head><body><div id="content"><!-- start content --><div id="page-heading"> <div style="padding-top: 100px; padding-bottom: 170px; text-align: center;"> <strong>Sistemas BTR - Transportes <p> Suporte Técnio:<br /><br /> Email/MSN:<a href="mailto:btr_marcio@hotmail.com"> btr_marcio@hotmail.com</a> <br /> Email/MSN:<a href="mailto:btr_maison@hotmail.com"> btr_maison@hotmail.com</a> </p> </strong> </div> </div><!-- end content --></div></body></html>