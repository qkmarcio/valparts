<?php 
    include_once "propriedades.php"; 
    session_start('login');
    @$_SESSION['servidor'] = $servidor; //variavel em propriedades.php    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Orquestra Doxologia Área Restrita</title>
	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
	
	<!--  jquery core -->
        <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>	
		
	<script type="text/javascript">
            function getlogar(){
                if ($("#usuario").val() && $("#senha").val() !=''){
                    var obj = new Object();
                    var array = new Array();

                    obj.usuario=$("#usuario").val();
                    obj.senha=$("#senha").val();
                    obj.array=array;

                    $.ajax({
                        type: "POST",
                        url: "view/vConsultaUsuario.php",
                        dataType:"json",
                        data: {'obj': obj,'action' : 'logar'},/*faz um post passando um obj e chama uma funcao no php*/
                        success: function(json){  
                            if (json.success == true){
                                alert('Seja Bem Vindo '+json.usu_nome);
                                window.location = 'html/principal.php';
                            }else{
                                alert('Usuario ou Senha Invalidos');
                                resetarTudo();
                            } 
                        },
                        error: function(){alert('Nao localizado'); }

                    });//fim do ajax
                }else{
                    alert('Usuario ou Senha esta Vazio');
                    darFocus();
                }
            }
		
            /* Esta funcao limpa todos os campos data, tipoPg e tbody */
            function resetarTudo(){
                $("#usuario").val('');
                $("#senha").val('');
                darFocus();
            }

            /* Esta funcao da focus no input numero  */
            function darFocus(){
                $('#usuario').focus();
            }
            $().ready(function() {
                $("#usuario").focus();
            });
	</script>
</head>

<body id="login-bg">

<!-- Main Body Starts Here -->
<div id="main_body">

<!-- Form Title Starts Here -->
<div class="form_title"><h2>Orquesta Doxologia</h2>

</div>
<!-- Form Title Ends Here -->

<!-- Form Starts Here -->
<div class="form_box">

<!--<form action="view/vConsultaUsuario.php?action=logar" method="post" name="login">-->

<!-- User Name -->
<p class="form_text">
Usuario
</p>

<p class="form_input_BG"><input type="text"  name="usuario" id="usuario" /></p>
<!-- User Name -->

<!-- Clear -->
<p class="clear">&nbsp;
</p>
<!-- Clear -->

<!-- Password -->
<p class="form_text" style="margin-left:8px;">
Senha
</p>

<p class="form_input_BG"><input type="password" value="************"  onfocus="this.value=''" name="senha" id="senha"/></p>
<!-- Password -->

<!-- Clear -->
<p class="clear">&nbsp;
</p>
<!-- Clear -->

<p class="form_check_box">
    Lembrar me
    <input type="checkbox" class="checkbox-size" id="login-check" name="login-check" checked />
</p>

<p class="form_login_signup_btn">
<input type="submit" class="submit-login" style="margin-left:240px;cursor: pointer" id="logor" value="logar" onclick="getlogar();"/>
</p>
<!--
</form>
-->
</div>
<!-- Form Ends Here -->

</div>
<!-- Main Body Ends Here -->

 </body>
</html>