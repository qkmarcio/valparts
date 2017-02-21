<?php
/*
 * Autor: Maison K. Sakamoto
 * Revisao: 0
 * Data: 23/02/2012
 *
 * Descricao: 
 * Listar Grupos, listar opcoes de acessos por grupo
 * em tempo de clique
 */

//Abaixo valicao de acesso do usuario
session_start('login');

if (!@$_SESSION["conectado"] == 'sim') {
	echo "<script language='JavaScript'>
				alert('Voce nao esta conectado, Favor logar novamente.');
 				window.location = '../index.php';
 			  </script>";
	echo "string";
	break;
}

include_once '../controller/ColAcesso.php';
include_once '../controller/OpenDB.php';

$open = new OpenDB();
$open->conectarNovamente($_SESSION['usuario'], $_SESSION['senha']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Sistemas BTR - Transportes</title>
        
        <script src="../lib/jquery.validate.js" type="text/javascript"></script>
        <script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="../js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
        <script src="../js/custom_jquery.js" type="text/javascript"></script>
        
    </head>
    <script type="text/javascript">
        
        $.noConflict();  
        //SUBMETER
        $('button').click(function(){
            var mod_id = new Array();
            
            $("input[type=checkbox]:checked").each(function(){
                var classId = $(this).attr('class');
                if(classId != 'todos'){ //VERIFICAR SE NAO É A MARCACAO "TODOS"
                    mod_id.push( $(this).attr('class') );    
                }
            });
            
            var obj = new Object();
            obj.grup_id = $('option:checked').attr('id');
            obj.mod_id = mod_id;
            
            $.ajax({
                type: "POST",
                url: "../view/vPermissoes.php",
                dataType:"json",
                data: {'obj': obj},
                beforeSend: function(){$(".aguarde").show('out'); },
                success: function(json){ 
                    alert('ok'); 
                    window.location = 'principal.php';
                },
                error: function(e){console.debug(e);alert('Erro use o Debug do Firefox para mais informacao');},
                complete: function(){$(".aguarde").hide('in'); }
            });//fim do ajax
            
        });
        
        //MUDANDO O GRUPO
        $('#seletor').change(function(){
            var grup_id = $('option:checked').attr('id');
            addAcessos(objAcesso,grup_id);
        });
        
        function eventoMarcarTodos(){
            //MARCAR TODOS DO GRUPO
            $(".todos").click(function(){
                if($(this).attr('checked')=='checked'){
                    marcarTodos($(this).attr('id'));
                }else
                    removerTodos($(this).attr('id'));
            });
        }
        
        function marcarTodos(grup_id){                
            for(i=0; i<objModulos.length; i++){                
                if(grup_id == 't'+objModulos[i].mod_ref){
                    $('.'+objModulos[i].mod_id).attr('checked', 'checked').trigger('change');                    
                }
            }
        }
        
        function removerTodos(grup_id){
            for(i=0; i<objModulos.length; i++){                
                if(grup_id == 't'+objModulos[i].mod_ref){
                    $('.'+objModulos[i].mod_id).removeAttr('checked').trigger('change');
                }
            }
        }
        
        function addGrupos(obj){
            for(index=0; index < obj.grupo.length; index++){
                $('#seletor').append(
                    '<option id=\''+obj.grupo[index].grup_id+'\'>' + 
                        obj.grupo[index].grup_nome + 
                    '</option>'
                );    
            }
            objAcesso=obj.objAcesso;
            objModulos=obj.modulos;
            //Criar os Itens do banco;
            criarItens(obj.modulos);
            addAcessos(obj.objAcesso,1);
        }
        
        function getTipoModulo(mod_id){
            for(i=0; i>objModulos.length; i++){
                if(objModulos[i].mod_id == mod_id){
                    return objModulos[i].mod_tipo;
                }
            }
        }
        
        function criarItens(objModulos){
            
            for(j=0; j < objModulos.length; j++){
                if(objModulos[j].mod_tipo == "MENU" || objModulos[j].mod_tipo == "MENU-2"){
                    var mod_id = objModulos[j].mod_id;
                    construirMenu(mod_id, objModulos[j].mod_apelido);
                    
                    for(i=0; i<objModulos.length; i++){ 
                        if(objModulos[i].mod_ref == mod_id){
                            $(".menu"+mod_id).append(
                                "<tr id='tr"+objModulos[i].mod_id+"'><td><input class='"+objModulos[i].mod_id+
                                "' type='checkbox'> "+objModulos[i].mod_apelido+"</input></td></tr>"
                            );
                        }
                    }
                }
            }
            eventoMarcarTodos();
        }
        
        function construirMenu(mod_id,mod_apelido){
            $("#trMenu").append(
                "<td valign='top' id='td"+mod_apelido+"' >"+
                    "<fieldset class='ui-widget ui-widget-content ui-corner-all td'>"+
                        "<legend class='ui-widget ui-widget-header ui-corner-all'>"+mod_apelido+"</legend>"+
                        "‌<table id='product-table' class='menu"+mod_id+"'>"+
                            "<tr><th><input id='t"+mod_id+"' class='todos' type='checkbox'> Marcar Todos</input></th></tr>"+
                        "</table>"+
                    "‌</fieldset>"+
                "</td>"
            );
        }
        
        function colorirTables(){
            //COLORIR TABLE TR
            $('input:checkbox').change(function(){   
                var id = $(this).attr('class');
                var status = $(this).attr('checked');
                status == 'checked' ? $('#tr'+id).css('background', '#FFDDDD') : $('#tr'+id).css('background', '#FFFFFF');
            });
        }
        
        function addAcessos(objAcesso,grup_id){
            colorirTables();
            
            for(j=0; j < objAcesso.length; j++){          //REMOVER SELECAO ANTERIOR
                $('.'+objAcesso[j].mod_id).removeAttr('checked');
                $('#tr'+objAcesso[j].mod_id).css('background', '#FFFFFF');  
                $('#t'+objAcesso[j].mod_id).removeAttr('checked');                
            }
            
            for(j=0; j < objAcesso.length; j++){            //SELECIONAR
                if (objAcesso[j].grup_id == grup_id && getTipoModulo(objAcesso[j].mod_id) != 'MENU'){
                    $('.'+objAcesso[j].mod_id).attr('checked', 'checked').trigger('change');
                    if (objAcesso[j].grup_id == 1){
                        $('#tdAdmin').hide('out');
                    }
                    else{
                        $('#tdAdmin').show('in');
                    }
                }
            }
        }
        
        function isArray(obj){
            return(typeof(obj.length)=="undefined")?false:true;
        }
        
        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "../view/vPermissoes.php",
                dataType:"json",
                data: {'grupo': 'flag'},
                beforeSend: function(){$(".aguarde").show('out'); },
                success: function(json){addGrupos(json); },
                error: function(e){console.debug(e);alert('Erro use o Debug do Firefox para mais informacao');},
                complete: function(){$(".aguarde").hide('in'); }
            });//fim do ajax
        });
    </script>
    

    <style type="text/css">
        #grupo {
            width: 300px;
            margin-bottom: 10px;
        }
        #product-table td{
            text-align: left;
        }
        #product-table {
            margin-bottom: auto;
        }
        .td{
            margin-right: 10px; 
        }
        .pop-up{
            position:absolute;
            top:50%;
            left:50%;
            margin-left:-250px;
            margin-top:-100px;
            padding:10px;
            width:500px;
            height:200px;
            border:1px solid #d0d0d0;
            background: white;
        }
        .aguarde{
            width: 320px; 
            height: 60px;
            margin-left:-150px;
            margin-top: 0px;            
            } 
     
        </style>
    <body>
        <center>
            <fieldset id="grupo" class="ui-widget ui-widget-content ui-corner-all">
                <legend class="ui-widget ui-widget-header ui-corner-all">Grupo</legend>
                ‌Nome: 
                    <select id="seletor" style="width: 100px;" ></select>
            ‌</fieldset>        
            
            <table>
                <tr id="trMenu"></tr>
            </table>
            <button class="ui-button" type="submit" tabindex="14">Atualizar</button>
        </center>        
    </body>
    <div class="aguarde pop-up">
        <legend class="ui-widget ui-widget-header ui-corner-all">Carregando</legend>
        <center><p style="padding-top: 15px;">Aguarde...</p></center>
    </div>
    <div id="result" style="height: 100px;"></div>
</html>
