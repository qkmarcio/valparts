<?php
/*
 * Autor: Marcio Souza
 * Revisao: 02
 * Data: 01/06/2012
 *
 * 
 */

//Abaixo valicao de acesso do usuario
@session_start('login');

if (!@$_SESSION["conectado"] == 'sim') {
	echo "<script language='JavaScript'>
		alert('Voce nao esta conectado, Favor logar novamente.');
 		window.location = 'index.php';
 	  </script>";
	echo "string";
	break;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administração Doxologia</title>

        
<link rel="stylesheet" type="text/css" media="screen" href="../css/blitzer/jquery-ui-1.8.17.custom.css" />
<script src="../js/head.js"></script>   
<script>
            head.js("../js/jquery-1.7.1.min.js")
            .js("../js/jquery-ui-1.8.17.custom.min.js")

</script>
        <!-- JS MASKARAS -->
	<script src="../js/jquery.meiomask.js" type="text/javascript"></script>
       
        <script type="text/javascript">
 
	$(document).ready(function(){
            $("#novo").hide();//oculta a div Editar Componente
        });
        
        function getDatePickerDefault(){
            return {dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                    dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab','Dom'],
                    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'],
                    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set', 'Out','Nov','Dez'],
                    nextText: 'Próximo',
                    prevText: 'Anterior'
            };
        }
        // CONFIGURAÇÃO DO DATEPICKER DO JQUERYUI PARA PT-BR Funcao no js/custom_jquery.js
            $.datepicker.setDefaults(getDatePickerDefault());
        
            $("#data").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange:"c-50:c+2" 
            });
            $("#data").attr("readonly","readonly");
            
        
	//Esta Funçao é chamada no final do script
        //Chama uma lista ao carregar a pagina
	function getLista(){
            $.ajax({
                type: "POST",
                url: "../view/vConsultaComponente.php",
                dataType:"json",
                data: {'funcao' : 'getLista'}, /*faz um post chama uma funcao no php*/
                beforeSend: function(){$(".aguarde").show('out'); },
                success: function(json){ 
                    geraLista(json);//Chama funcao geraLista e passa o objeto
                },
                error: function(){alert('Lista não localizada'); },
                complete: function(){$(".aguarde").hide('in'); }
            });
            //fim do ajax*/      
	};
	
        //Cria uma lista na tela em tabela com link no nome para editar
	function geraLista(obj){
            var linha = '';
            var linhaInativo = '';
                for (var i = 0; i < obj.length; i++) {
                    if(obj[i].statos =='Ativo'){
                	linha += '<tr style="height:13px; cursor:pointer" onclick="carregaObjeto('+obj[i].id+');" >'+
                                    '<td style="text-align: left" >'+obj[i].Nome+'</td>'+
                                    '<td >'+obj[i].Telefone+'</td>'+
                                    '<td >'+obj[i].Celular+'</td>'+
                                    '<td style="text-align: left">'+obj[i].Instrumento+'</td>'+
                                    '<td >'+obj[i].Nascimento+'</td>'+
                                 '</tr>';
                    }else{
                        linhaInativo += '<tr style="height:13px; cursor:pointer;" onclick="carregaObjeto('+obj[i].id+');" >'+
                                    '<td style="text-align: left" >'+obj[i].Nome+'</td>'+
                                    '<td >'+obj[i].Celular+'</td>'+
                                    '<td style="text-align: left">'+obj[i].Instrumento+'</td>'+
                                 '</tr>';
                    }
                }
                $('table#product-table > tbody').empty();
                $('table#product-table > tbody').append(linha); //Carrega a lista na tabela de (id=product-table)
                $('table.Inativo > tbody').empty();
                $('table.Inativo > tbody').append(linhaInativo); //Carrega a lista na tabela de (id=product-table)
         }
	
        //Pega o Codigo selecionado e faz um post para receber os objesto do codigo enviado
	function carregaObjeto(id){
            var obj = new Object();  
                obj.id = id;
            $.ajax({
                type: "POST",
                url: "../view/vConsultaComponente.php",
                dataType:"json",
                data: {'obj':obj ,'funcao' : 'getEditar'}, /*faz um post chama uma funcao no php*/
                beforeSend: function(){$(".aguarde").show('out'); },
                success: function(json){ 
                    loadEditar(json);//Chama funcao geraLista e passa o objeto
                },
                error: function(){alert('Lista não localizada'); },
                complete: function(){$(".aguarde").hide('in'); }
            });
            //fim do ajax*/ 
        }

        // Recebe o objeto escreve nas inputs e chama a div 
	function loadEditar(obj) {
            $('#id').val(obj.id);
            $('#nome').val(obj.Nome);
            $('#data').val(obj.Nascimento);
            $('#email').val(obj.Email);
            $('#telefone').val(obj.Telefone);
            $('#celular').val(obj.Celular);
            $('#endereco').val(obj.Endereco);
            $('#bairro').val(obj.Bairro);
            $('#cep').val(obj.Cep);
            $('#instrumento').val(obj.Instrumento);            
            $('#descricao').val(obj.Observacao);
            
            
            if(obj.Statos == 'Ativo'){
               $('#ativo').attr("checked","checked"); 
            }
            else{
                $('#ativo').attr("checked",""); 
                $('#inativo').attr("checked","checked"); 
            }
            
            getEdit(); //Chama a div com os inputs e os objetos para editar
        }
			
			
	function getEdit(){
            var vwidth = 600;
            var vheight = 540;

            $('#novo').dialog({
                title: 'Editar Componente',          
                modal: true,
                width: vwidth,
                height: vheight,
                closeOnEscape: true
            });
            return false;
            
        }
       (function($){
            $(function(){
                $('input:text').setMask();
            });
        })(jQuery);
        $.mask.masks = $.extend($.mask.masks,{
            cep:{ mask: '99999-999' },
            phone:{ mask: '(99)9999-9999' }			
        });
        
	getLista();//chama lista ao carregar a pagina
	$.noConflict();
        </script>
          <style type="text/css">
            input{text-transform: capitalize;}/*Para que todos os dados sejam capturados com maiusculas*/
            body { font-size: 62.5%; line-height: 100%; }
            label { display: inline-block;  }
            legend { padding: 0.5em; }
            fieldset fieldset label { display: block; }
            table {border-collapse: separate;}
            th{padding: 10px;}
            .ui-widget .ui-widget {margin-bottom: 10px;}	
            #signupForm { 
                    width: 700px;
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
        <div id="signupForm"style="width: 1000px">
            <fieldset class="ui-widget ui-widget-content ui-corner-all" style="width: 550px;float: left">
                <legend class="ui-widget ui-widget-header ui-corner-all">Lista de Componente Ativo</legend>				
                <table id="product-table" width="100%">
                    <thead>
                        <tr>
                            <th width="30%">Nome</th>
                            <th width="15%">Telefone</th>
                            <th width="15%">Celular</th>
                            <th width="20%">Instrumento</th>
                            <th width="11%">Nascimento</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </fieldset>
            <fieldset class="ui-widget ui-widget-content ui-corner-all"style="width: 400px;">
                <legend class="ui-widget ui-widget-header ui-corner-all">Lista de Componente Inativo</legend>				
                <table id="product-table" class="Inativo" width="100%">
                    <thead>
                        <tr>
                            <th width="30%">Nome</th>
                            <th width="15%">Celular</th>
                            <th width="20%">Instrumento</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </fieldset>
        </div>		
   </center>
   <!--Div editar Componente-->
       <form id="novo" action="../view/vCadastroComponente.php" name="signupForm" method="post" enctype="multipart/form-data">
       <fieldset class="ui-widget ui-widget-content ui-corner-all">
            <table width="100%">
                <tr>
                    <th>Nome:</th>
                    <td>
                        <input type="hidden" name="id" id="id"/>
                        <input name="nome" id="nome" tabindex="1"/>
                    </td>
                </tr>
                <tr>
                    <th>Nascimento:</th>
                    <td>
                        <input name="data" id="data" alt="date" tabindex="2" />
                    </td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>
                        <input id="email" name="email" tabindex="3"  />
                    </td>
                </tr>
                <tr>
                    <th>Telefone:</th>
                    <td><input id="telefone" name="telefone" tabindex="4" alt="phone" /></td>
                </tr>
                <tr>
                    <th>Celular:</th>
                    <td><input id="celular" name="celular" tabindex="5" alt="phone" /></td>
                </tr>
                <tr>
                <th>Endereco:</th>
                    <td>
                        <input id="endereco" name="endereco" tabindex="6" />
                    </td>
                </tr>
                <tr>
                    <th>Bairro:</th>
                    <td>
                        <input id="bairro" name="bairro" tabindex="7" />
                    </td>
                </tr>
                <tr>
                    <th>CEP:</th>
                    <td>
                        <input id="cep" name="cep" tabindex="8" alt="cep"  />
                    </td>
                </tr>
                <tr>
                    <th>Ativo</th>
                    <td>
                        <input type="radio" name="radio" value="Ativo" id="ativo" checked="checked" tabindex="9" />
                        <label for="orange">Sim</label>
                        <input type="radio" name="radio" value="Inativo" id="inativo" tabindex="10"/>
                        <label for="orange">Não</label>
                    </td>
                </tr>
                <tr>
                    <th>Instrumento:</th>
                    <td>
                        <select id="instrumento" name="instrumento" size="1" tabindex="11">
                            <option value="" selected="selected">Selecionar função</option>
                            <option value="1 VIOLINO">1 VIOLINO</option>
                            <option value="2 VIOLINO">2 VIOLINO</option>
                            <option value="BAIXO">BAIXO</option>
                            <option value="CELLO">CELLO</option>
                            <option value="CLARINETA">CLARINETA</option>
                            <option value="FLAUTA">FLAUTA</option>
                            <option value="PERCUSSAO">PERCUSSAO</option>
                            <option value="SAX ALTO">SAX ALTO</option>
                            <option value="SAX SOPRANO">SAX SOPRANO</option>
                            <option value="SAX TENOR">SAX TENOR</option>
                            <option value="TECLADO">TECLADO</option>
                            <option value="TROMBONE">TROMBONE</option>
                            <option value="TROMPA">TROMPA</option>
                            <option value="TROMPETE">TROMPETE</option>
                            <option value="VIOLA">VIOLA</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Foto (.png) perfil do musico:</th>
                    <td>
                        <input id="foto" name="foto" type="file"  tabindex="12" />
                    </td>
                </tr>
                <tr>                                                
                    <th>Observação:</th>
                    <td>
                        <textarea id="descricao" name="descricao" class="ui-widget-content" cols="50" rows="3"  tabindex="13"></textarea>
                    </td>
                </tr>
                <tr>
                  <td td colspan="2" style="text-align:right; "><input type="submit" class="Botao" id="salvar" value="Salvar" style="cursor: pointer" tabindex="14" /></td>
                </tr>
            </table>
        </fieldset>
       </form>
</body>
</html>
