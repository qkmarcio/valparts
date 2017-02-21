<?php
/*
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 29/02/2012
 *
 * Aqui Cadastro e Altera Componente
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
        <form id="signupForm" action="../view/vCadastroComponente.php" name="signupForm" method="post" enctype="multipart/form-data">    
            <fieldset class="ui-widget ui-widget-content ui-corner-all">
                <legend class="ui-widget ui-widget-header ui-corner-all">Cadastro de Componente</legend>				
                <table id="id-form">
                    <tr>
                        <th>Nome:</th>
                        <td>
                            <input type="hidden" name="id" id="id" />
                            <input name="nome" id="nome" tabindex="1"/>
                        </td>
                    </tr>
                    <tr>
                        <th>Nascimento:</th>
                        <td>
                            <input id="data" name="data" alt="date" tabindex="2" />
                        </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>
                            <input id="email" name="email" tabindex="3" style="text-transform: lowercase"  />
                        </td>
                    </tr>
                    <tr>
                        <th>Telefone:</th>
                        <td><input id="telefone" name="telefone" alt="phone" tabindex="4" alt="phone" /></td>
                    </tr>
                    <tr>
                        <th>Celular:</th>
                        <td><input id="celular" name="celular" alt="phone" tabindex="5" alt="phone" /></td>
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
                            <input id="cep" name="cep" alt="cep" tabindex="8" alt="cep" />
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
                                <option value="" selected="selected"></option>
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
                            <input id="foto" type="file" name="foto" tabindex="12" />
                        </td>
                    </tr>
                    <tr>                                                
                        <th>Observação:</th>
                        <td>
                            <textarea id="descricao" name="descricao" class="ui-widget-content" cols="100" rows="3"  tabindex="13"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td td colspan="2" style="text-align:right; "><input type="submit" class="Botao" id="salvar" value="Salvar" style="cursor: pointer" tabindex="14" /></td>
                    </tr>
                </table>
            </fieldset>
        </form>		
    </center>
    <script type="text/javascript">
        loadjscssfile('../lib/jquery.validate.js','js');
        loadjscssfile('../js/jquery-1.7.1.min.js','js');
        loadjscssfile('../js/jquery.meiomask.js','js');
        loadjscssfile('../js/jquery-ui-1.8.17.custom.min.js','js');
        loadjscssfile('../js/CadastroComponente.js','js');
    </script>
</body>
</html>
