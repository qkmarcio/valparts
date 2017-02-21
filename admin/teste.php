<?php

/*$con=mysql_connect("nhs1.nhserver.com.br", "orquestr_site", "Minotauro@036");
mysql_select_db("orquestr_remoto");*/

include_once '../controller/OpenDB.php';
    conectar();
    //Verifica a conexao do usuario e conecta no banco
    function conectar(){
        //Conexao com o Banco
        $open = new OpenDB();
        $open->setUsuario('orquestr_site');
        $open->setSenha('Minotauro@036');
        $open->conectar();
    }
    
    
$query ="SELECT * 
                    FROM tab_usuario 
                    WHERE usu_nome='admin' and usu_senha='admin' ";
        $result = mysql_query($query);


$linha = mysql_num_rows($result);
            if ($linha != 1) {
                $resultado["success"] = false;
				$resultado["errors"]["reason"] = "Usuario ou senha invalido(s)";
            } else {
				$resultado = mysql_fetch_assoc($result);
				if (!isset($_SESSION)) session_start();
					$_SESSION['usu_id'] = $resultado['usu_id'];
					$_SESSION['usu_nome'] = $resultado['usu_nome'];
					$resultado["success"] = true;
			}
	echo json_encode($resultado);

?>
