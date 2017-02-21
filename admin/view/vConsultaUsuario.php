<?php
/**
 * @author Marcio O. Souza
 * Data: 09/01/01
 * @version 0
 * @todo Relatorio da carta frete
 */
    include_once '../controller/ColConectar.php';
    include_once '../controller/ColUsuario.php';
    include_once '../model/Class.Usuario.php';
    
    @session_start('login');
    
    // Recebe os campos dos formulário via POST
    
    # Rcebe a funcao do javascript    
    $funcao = $_REQUEST['action'];
    
    # Verifica qual funcao sera chamada no php
    call_user_func($funcao);
    
    function logar() {
        $obj = (object) $_REQUEST['obj'];
        
        $conColl = new ColUsuario();
        $conArray = $conColl->getLogar($obj->usuario,$obj->senha);
        
        $linha = mysql_num_rows($conArray);
            if ($linha != 1) {
                $resultado["success"] = false;
                $resultado["errors"]["reason"] = "Usuario ou senha invalido(s)";
            }else {
                $resultado = mysql_fetch_assoc($conArray);
                if (!isset($_SESSION)) session_start();
                    $_SESSION['usu_id'] = $resultado['usu_id'];
                    $_SESSION['usu_nome'] = $resultado['usu_nome'];
                    $resultado["success"] = true;
            }
        echo json_encode($resultado);
    }
        
    function getEditar(){
        $obj = (object) $_REQUEST['obj'];
        $conColl = new Colcomponente();
        $conArray = $conColl->getById($obj->id);

        //conta o array e depois escreve ate o final
        $obj=
            array(
                'id'=>$conArray->idcomponente,
                'Nome'=>$conArray->comnome,
                'Nascimento'=>Formatador::dateEmPortugues($conArray->comnascimento),
                'Telefone'=>$conArray->comtelefone,
                'Celular'=>$conArray->comcelular,
                'Endereco'=>$conArray->comendereco,
                'Bairro'=>$conArray->combairro,
                'Email'=>$conArray->comemail,
                'Cep'=>$conArray->comcep,
                'Statos'=>$conArray->comstatos,
                'Instrumento'=>$conArray->cominstrumento,
                'Observacao'=>$conArray->comobservacao,
            );

        echo json_encode($obj);
    }

?>
