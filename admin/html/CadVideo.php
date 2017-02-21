<?php
/*
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 10/04/2012
 *
 * Aqui Cadastro e Altera Componente
 */

//Abaixo valicao de acesso do usuario
session_start('login');

if (!@$_SESSION["conectado"] == 'sim') {
	echo "<script language='JavaScript'>
                alert('Voce nao esta conectado, Favor logar novamente.');
 		window.location = 'index.php';
              </script>";
	echo "string";
	break;
}
include_once '../controller/ColConectar.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administração</title>

        <!-- EFEITO DE ANIMACAO -->
        <script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
        <script src="../js/custom_jquery.js" type="text/javascript"></script>
        
        <script type="text/javascript">
                
        function getSalvar(){
            if($('#categoria').val() !=''){
                var obj = new Object();  
                        obj.vid_categoria =  $('#categoria').val();
                        obj.vid_titulo =  $('#titulo').val();
                        obj.vid_descricao =  $('#descricao').val();
                        obj.vid_url = $('#url').val();

                    $.ajax({
                        type: "POST",
                        url: "../view/vCadastroGaleria.php",
                        dataType:"json",
                        data: {'obj': obj, 'funcao' : 'novoVideo'}, /*faz um post passando um obj e chama uma funcao no php*/
                        beforeSend: function(){$(".aguarde").show('out'); },
                        success: function(json){alert('Finalizado com sucesso!'); darFocus();},
                        error: function(){alert('Nao localizado'); },
                        complete: function(){$(".aguarde").hide('in'); }
                    });
                    //fim do ajax*/
                }else{
                    alert('Nome e Url Obrigatorio!!');
                    darFocus();
                }
            };
        function darFocus(){
            $('#categoria').val('');
            $('#url').val('');
            $('#categoria').focus();
        }
        $.noConflict();//usado para separar as variaveis já iniciadas
        </script>
        <style type="text/css">
            input{text-transform: none;}/*Para que todos os dados sejam capturados com maiusculas*/
            body { font-size: 62.5%; line-height: 100%; }
            label { display: inline-block;  }
            legend { padding: 0.5em; }
            fieldset fieldset label { display: block; }
            table {border-collapse: separate;}
            th{padding: 10px;}
            .ui-widget .ui-widget {margin-bottom: 10px;}	
            #signupForm { 
                    width: 800px;
                    padding-top: 30px;
                    padding-bottom: 10px; 
            }
            #signupForm label.error {
                    margin-left: 5px;
                    width: auto;
                    display: inline;			
            }
            #product-table th{text-align: center; height: 15px;}
            #product-table td{padding: 2px 0px 2px 0px; text-align: center;}
            #product-table{margin-bottom: 0px;padding-top: 0px;padding-bottom: 0px;}
        </style>
</head>
<body>
    <center>
        <div id="signupForm" >    
            <fieldset class="ui-widget ui-widget-content ui-corner-all">
                <legend class="ui-widget ui-widget-header ui-corner-all">Cadastro de Videos</legend>				
                <table id="id-form">
                    <tr>
                        <th>Categorias:</th>
                        <td>
                          <select name="categoria" id="categoria" tabindex="1" >
                            <?php
                                include_once '../controller/ColGaleria.php';
                                $conCol = new ColGaleria();
                                $conArray = $conCol->getAllVideoCategoria();
                                for ($i=0; $i < count($conArray); $i++){//conta o array e depois escreve ate o final
                                    echo "<option value='".$conArray[$i]->categoria_id."'>".$conArray[$i]->cat_nome."</option>";                        
                                }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Titulo:</th>
                        <td>
                            <input id="titulo" name="titulo" tabindex="2" size="50" />
                        </td>
                    </tr>
                    <tr>
                        <th>Descrição:</th>
                        <td>
                            <textarea id="descricao" name="descricao" tabindex="3"  />
                        </td>
                    </tr>
                    <tr>
                        <th>Url (vimeo, youtube):</th>
                        <td>
                            <input id="url" name="url" tabindex="4" size="50" />
                        </td>
                    </tr>
                    <tr>
                        <td td colspan="2" style="text-align:right; "><input type="submit" class="Botao" id="salvar" value="Salvar" style="cursor: pointer" onclick="getSalvar();" tabindex="14" /></td>
                    </tr>
                </table>
            </fieldset>
        </div>		
    </center>
</body>
</html>