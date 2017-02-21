<?php
/*
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 04/09/2012
 *
 * Aqui Cadastro da Loja
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
include_once '../controller/ColConectar.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administração</title>

        <!-- EFEITO DE ANIMACAO -->
    
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
        <form id="signupForm" action="../view/vCadastroloja.php" name="signupForm" method="post" enctype="multipart/form-data">    
            <fieldset class="ui-widget ui-widget-content ui-corner-all">
                <legend class="ui-widget ui-widget-header ui-corner-all">Cadastro de Produtos</legend>				
                <table id="id-form">
                    <tr>
                        <th>Categorias:</th>
                        <td>
                          <select name="categoria" id="categoria" tabindex="1" >
                            <?php
                                include_once '../controller/ColLoja.php';
                                $conCol = new ColLoja();
                                $conArray = $conCol->getAllLojaCategoria();
                                for ($i=0; $i < count($conArray); $i++){//conta o array e depois escreve ate o final
                                    echo "<option value='".$conArray[$i]->loja_categoria_id."'>".$conArray[$i]->loja_cat_nome."</option>";                        
                                }
                            ?>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Nome:</th>
                        <td>
                            <input type="hidden" name="id" id="id" />
                            <input name="nome" id="nome" tabindex="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Preço:</th>
                        <td>
                            <input id="preco" name="preco" alt="decimal" tabindex="2" />
                        </td>
                    </tr>
                    <tr>
                        <th>Desconto:</th>
                        <td>
                            <input id="desconto" name="desconto" alt="decimal" tabindex="3" />
                        </td>
                    </tr>
                    <tr>
                        <th>Colocar na Pricipal:</th>
                        <td>
                            <input type="radio" name="radio" value="1" id="ativo"  tabindex="4" />
                            <label for="orange">Sim</label>
                            <input type="radio" name="radio" value="0" checked="checked" id="inativo" tabindex="5"/>
                            <label for="orange">Não</label>
                        </td>
                    </tr>
                    <tr>
                        <th>Foto do produto (.jpg) pixels 300x300:</th>
                        <td>
                            <input id="foto" type="file" name="foto" tabindex="6" />
                        </td>
                    </tr>
                    <tr>                                                
                        <th>Descrição:</th>
                        <td>
                            <textarea id="descricao" name="descricao" class="ui-widget-content" cols="100" rows="3"  tabindex="7"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td td colspan="2" style="text-align:right; "><input type="submit" class="Botao" id="salvar" value="Salvar" style="cursor: pointer" tabindex="8" /></td>
                    </tr>
                </table>
            </fieldset>
        </form>		
    </center>
    <script type="text/javascript">
        loadjscssfile('../lib/jquery.validate.js','js');
        loadjscssfile('../js/jquery-1.7.1.min.js','js');
        loadjscssfile('../js/jquery.meiomask.js','js');
        loadjscssfile('../js/CadastroLoja.js','js');
    </script>
</body>
</html>