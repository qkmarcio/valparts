<?php
	/*
	 * Autor: Maison K. Sakamoto
	 * Revisao: 0
	 * Data: 12/12/2011
	 * 
	 * Arquivo principal do sistema, faz chamadas para todas as interfaces
	 */

        //Abaixo valicao de acesso do usuario
	session_start('login');
	
	if(!@$_SESSION["conectado"]=='sim'){
		echo "<script language='JavaScript'>
				alert('Voce nao esta conectado, Favor logar novamente.');
 				window.location = 'index.php';
 			  </script>";
	}
?>

	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Sistemas BTR - Transportes</title>
        <link rel="stylesheet" type="text/css" media="screen" href="../css/screen.css" title="default" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/navbar.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="../css/blitzer/jquery-ui-1.8.17.custom.css" />

</head>
<body> 
	<div id="page-top-outer">                
		<div id="page-top">
			<div id="top-right">
                            <table>
                                <tr>
                                    <td valign="bottom">Bem vindo <?php echo @$_SESSION["usu_nome"]." !"?></td>
                                </tr>
                            </table>    
			</div><!-- End: top-right -->
		</div><!-- End: page-top -->
	</div><!-- End: page-top-outer -->
        
        <div class="clear">&nbsp;</div><!-- QUEBRA DE LINHA -->
	
        <div class="nav-outer-repeat">
            <div id="logo">
                <!--<a href="principal.php" id="logo-img"><img width="100%" height="100%" alt="" src="../../images/logo1.png"></a>-->
            </div>
            <ul id="nav" class="nav-outer">	
                <div style="float: left;">
                    <?php require_once ('../view/vPermissoes.php'); getMenu(); ?>	
                </div>
                <div style="float: right;">
                    <li><a href="https://picasaweb.google.com/103624403003282633521" target="foto">Up Foto</a></li>
                    <!--<li><a href="http://imageshack.us/" target="foto">Up Foto</a></li>-->
                    <li><a href="#">Minha conta</a>
                        <ul>
                            <li><a href="javascript:loadContent('#conteudo','editarConta.php')">Editar Conta</a></li>                            
                        </ul>
                    </li>
                    <li><a href="../../index.php">Sair</a></li>
					
                </div>
            </ul>
        </div>
        
	<div id="content-outer"><div id="conteudo"></div></div>
	
	<div class="clear">&nbsp;</div>
        
        <div id="footer">
            <div id="footer-left">
            &copy; Copyright 
                    <a href="http://www.bibliaonline.com.br/acf/cl/3/17" style="text-decoration: underline">
                            Colossenses 3:17
                    </a> 
                    | 
                    <a href="../../index.php" style="text-decoration: underline">
                            www.orquestradoxologia.com.br
                    </a>. All rights reserved.
            </div><!--  end footer-left -->            
        </div>	<!-- end footer -->	
        
        <div id="controle">
            <?php include_once "../propriedades.php"; 
                echo "servidor: ".$servidor." | "."versao: "."$versao" ;

                if(@$_SESSION["sub_menu"] == 'NULL' ){
                    echo "<input type='hidden' id='sub_menu' value='inicial.php'/>";
                }
                else if(strcmp(@$_SESSION["sub_menu"],"" == 0 ) ){
                    echo "<input type='hidden' id='sub_menu' value='inicial.php'/>";                
                }
                else{                
                    echo "<input type='hidden' id='sub_menu' value='".@$_SESSION["sub_menu"]."'/>";                
                }
            ?>
        </div>        
        <div id="carregando" title="Aviso" style="font-size: 8pt">Carregando...</div> 
        <script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
        <script src="../js/jquery.shortcuts.min.js" type="text/javascript"></script>
        <script src="../js/principal.js" type="text/javascript"></script>  
</body>    
</html>
