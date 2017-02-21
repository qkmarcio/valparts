<?php
/*
 * Autor: Marcio O de Souza 
 * Revisao: 1
 * Data: 25/11/2016
 */

session_start();
//include_once "propriedades.php";
if (isset($_SESSION['logado']) && $_SESSION['logado'] == 'SIM'):
    header("Location: home.php");
endif;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sistema Valparts S.A</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <style type="text/css">
            input{text-transform: uppercase;}
            textarea{text-transform: uppercase;}
            
            #login-alert{display: none;}
            .margin-top-pq{margin-top: 10px;}
            .margin-top-md{margin-top: 25px;}
            .margin-bottom-md{margin-bottom: 25px;}
            .padding-top-md{padding-top: 30px;}
        </style>
    </head>
    <body>
        <div class="container">    
            <div id="loginbox" class="mainbox col-md-7 col-md-offset-3 col-sm-8 col-sm-offset-2 margin-top-md">                    
                <div class="panel panel-primary" >
                    <div class="panel-heading">
                        <div class="panel-title">Login</div>
                    </div>     
                    <div class="panel-body padding-top-md" >
                        <div id="login-alert" class="alert alert-danger col-sm-12">
                            <span class="glyphicon glyphicon-exclamation-sign"></span>
                            <span id="mensagem"></span>
                        </div>      
                        <form id="login-form" class="form-horizontal" role="form" action="view/login.php" method="post">             
                            <div class="input-group margin-bottom-md">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="Usuário" class="form-control" id="usuario" name="usuario" required placeholder="Informe seu Login">                                        
                            </div>
                            <div class="input-group margin-bottom-md">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" id="senha" name="senha" required placeholder="Informe sua Senha">
                            </div>
                            <div class="form-group margin-top-pq">
                                <div class="col-sm-12 controls">
                                    <button type="button" class="btn btn-primary" name="btn-login" id="btn-login">
                                        Entrar
                                    </button>
                                </div>
                            </div> 
                        </form>     
                    </div>  
                </div>  
            </div>
        </div>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <script>
            $('document').ready(function () {
                $("#btn-login").click(function () {
                    //var obj = $("#login-form").serialize();
                    console.info(obj);
                    var obj = new Object();
                    obj.usuario = $("#usuario").val();
                    obj.senha = $("#senha").val();

                    $.ajax({
                        type: 'POST',
                        url: 'view/vUsuario.php',
                        //data: data,
                        data: {'obj': obj, 'action': 'logar'}, /*faz um post passando um obj e chama uma funcao no php*/
                        dataType: 'json',
                        beforeSend: function ()
                        {
                            $("#btn-login").html('Validando ...');
                        },
                        success: function (response) {
                            if (response.success == true) {
                                $("#btn-login").html('Entrar');
                                $("#login-alert").css('display', 'none');
                                //alert('Seja Bem Vindo ' + response.usu_nome);
                                window.location.href = "home.php";
                            } else {

                                $("#btn-login").html('Entrar');
                                $("#login-alert").css('display', 'block')
                                $("#mensagem").html('<strong>Erro! </strong> Usuario ou Senha Invalidos');
                                resetarTudo();
                            }

                            /* if (response.codigo == "1") {
                             $("#btn-login").html('Entrar');
                             $("#login-alert").css('display', 'none')
                             window.location.href = "home.php";
                             } else {
                             $("#btn-login").html('Entrar');
                             $("#login-alert").css('display', 'block')
                             $("#mensagem").html('<strong>Erro! </strong>' + response.mensagem);*/
                        }
                    });
                });

                function resetarTudo() {
                    $("#usuario").val('');
                    $("#senha").val('');
                    darFocus();
                }
                /* Esta funcao da focus no input numero  */
                function darFocus() {
                    $('#usuario').focus();
                }
                $().ready(function () {
                    $("#usuario").focus();
                });

            });


        </script>   
    </body>
</html>