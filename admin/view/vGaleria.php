<?php
/**
 * @author Marcio O. Souza
 * Data: 09/01/01
 * @version 0
 * @todo Consulta Ref os Musicos para o  site e are administrativa
 */


    include_once '../controller/ColGaleria.php';
    include_once '../model/Class.Galeria.php';
    include_once '../propriedades.php'; 
    include_once '../controller/OpenDB.php';
    
    conectar();
    	//Verifica a conexao do usuario e conecta no banco
    	function conectar(){
       	 //Conexao com o Banco
        	$open = new OpenDB();
        	$open->setUsuario('root');
        	$open->setSenha('');
        	$open->conectar();
    	}
    
    @$_SESSION['servidor'] = $servidor; //variavel em propriedades.php 
    @session_start('login');

    # Recebe os campos dos formulário via POST

    # Rcebe a funcao do javascript    
    @$funcao = $_REQUEST['funcao'];

    # Verifica qual funcao sera chamada no php
    @call_user_func($funcao);

    function getNewVideo(){
        $conCol = new ColGaleria();
        $conArray = $conCol->getAllVideo();
        for ($i=0; $i < count($conArray); $i++){//conta o array e depois escreve ate o final
            if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $conArray[$i]->getVidUrl(), $matches)){
                echo '                
                <h2>'. $conArray[$i]->getVidNome() .'</h2>
                    <p><a href="http://www.youtube.com/v/'.$matches[2].'" rel="shadowbox;width=600;height=450">
                            <img src="images/assistir.jpg" />
                    </a></p>
                ';
         
            }
        }
    }
    ?>
