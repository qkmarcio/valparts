<?php
    include_once '../controller/ColAcesso.php';
    include_once '../controller/ColUsuario.php';
    include_once '../controller/OpenDB.php';
    //include_once '../controller/ColUnidade.php';
    include_once '../model/Class.Usuario.php';
    include_once '../lib/Formatador.php';
    
    session_start('login');
    
    $con = new OpenDB();
    $con->conectarNovamente($_SESSION['usuario'],$_SESSION['senha']);
    
    $novoGrupo = @$_REQUEST['novo_grupo'];
    $novoUsuario = @$_REQUEST['novo_usuario'];
    $removeGrupo = @$_REQUEST['remove_grupo'];
    //$mudaGrupo = @$_REQUEST['muda_grupo'];
    $usu_id = @$_REQUEST['inativar'];
    $resetar = @$_REQUEST['resetar'];
    
    $colAcesso = new ColAcesso();
    
    if( !is_null($resetar) ){
        $colUsuario = new ColUsuario();
        $nova_senha = $colUsuario->gerarSenha();
        $colUsuario->resetSenha($resetar, $nova_senha);
        
        $j = array("retorno"=>"Nova Senha Para ".$resetar." é ".$nova_senha );
        echo json_encode($j);
    }
    else if( !is_null($usu_id) ){
        $colAcesso->inativarUsuario($usu_id);
        $j = array("retorno"=>"Cancelado com Sucesso!");
        echo json_encode($j);
    }
    else if( !is_null($novoUsuario) ){
        $colUsuario = new ColUsuario();
        $u = new Usuario();
        $u->setUsuEmail($novoUsuario['email']);
        $u->setUsuNome($novoUsuario['nome']);
        $u->setUniId($novoUsuario['uni_id']);
        
        ;
        if($colUsuario->isInativo($u->getUsuNome()) == true){
            $j = array("retorno"=>"Ja Existe Cadastro para este Usuario, porem esta INATIVO!");
        }
        else{
            $colUsuario->inserir($u,$novoUsuario['senha'],$novoUsuario['grup_id']);    
            $j = array("retorno"=>"Cadastrado com Sucesso!");
        }
        
        echo json_encode($j);
    }
    /*else if( !is_null($mudaGrupo) ){
        $colAcesso->mudarUsuarioDeGrupo( $mudaGrupo['usu_id'], $mudaGrupo['grup_id'] );
        $j = array("retorno"=>"Cadastrado com Sucesso!");
        echo json_encode($j);
    }*/
    else if( !is_null($novoGrupo) ){
        $colAcesso->inserirGrupo( strtoupper($novoGrupo) );
        $j = array("retorno"=>"Cadastrado com Sucesso!");
        echo json_encode($j);
    }
    else if( !is_null($removeGrupo) ){
        $colAcesso->removeGrupo($removeGrupo);
        $j = array("retorno"=>"Removido com Sucesso!");
        echo json_encode($j);
    }
    /*else{
        $cUnidade = new ColUnidade();
        $cidade = $cUnidade->getAll();
        $grupUsu = $colAcesso->getGrupoUsuario();
        $grupUsu['unidade'] = $cidade;
        
        echo json_encode($grupUsu);
    }
    */
?>
