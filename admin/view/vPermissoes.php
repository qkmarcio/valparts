<?php
    include_once '../controller/ColAcesso.php';
    include_once '../controller/ColConectar.php';    
    
    @session_start();
    
    # Rcebe a funcao do javascript
    @$funcao = $_REQUEST['action'];
    
    # Verifica qual funcao sera chamada no php
    @call_user_func($funcao);
    
    function getMenu(){
        $usu_id = $_SESSION['usu_id'];
        $conColl = new ColAcesso();
        $conArray = $conColl->fomularioUsuario($usu_id);
        
       # Array para montar a estrutura do menu
        $obj = array();

        # Variáveis para montar a nova estrutura
        $menu = 0;
        $submenu = 0;
        
        # Percorre o retorno dos dados
        for($i = 0; $i < count($conArray); $i++){
            
            # Cria o menu
            $obj[$menu]['<li><a href=#>'] = $conArray[$i]['mod_nome'].'< 1a><ul>';
            # Cria o submenu<li><a id='consultaCarta' href="javascript:loadContent('#conteudo','consultaFrete.php');">
            $obj[$menu]['M'][$submenu]['S'] ='<li><a href=javascript:loadContent('."'".'#conteudo'."','".$conArray[$i]['for_url']."'".')>'.$conArray[$i]['for_nome'].'< 1a>< 1li>';

            # Incrementa para o próximo submenu
            $submenu++;

            # Se existe o próximo menu e o próximo menu é diferente do menu atual
            if(array_key_exists(($i + 1), $conArray) && $conArray[$i]['mod_nome'] !== $conArray[$i + 1]['mod_nome']){
                    # Inicia o novo menu
                    $menu++;
                    # Reinicia o contador para iniciar um novo submenu do novo menu
                    $submenu = 0;
            }
    	
        }
       $test = json_encode($obj);
       #var_dump($test);
       getFormulario($test);
    }
    
    function getFormulario($obj){
        $um = str_replace('{"<li><a href=#>":"','<li><a href="#">',$obj);
	$dois = str_replace('< 1a><ul>","M":[', '</a><ul>',$um);
	$tres = str_replace('{"S":"','',$dois);
        $quatro = str_replace('< 1a>< 1li>', '</a></li>',$tres);
	$cinco = str_replace('"}]}', '</ul></li>',$quatro);
	$seis = str_replace('"},', '',$cinco);
	/*$sete = str_replace('[', '',$seis);
        $oito = str_replace(']', '',$sete);*/

        echo $seis;
        
    }
?>
