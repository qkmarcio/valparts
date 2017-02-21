<?php
include '../controler/OpenDB.php';
include '../controler/ColMotorista.php';

//set
$c = new ColMotorista();

//route
$action = $_REQUEST['action'];

if(!isset($action))
{
	die();
}
else
{
	$action();
}

function insert() {
    $obj = (object) $_REQUEST['obj'];

    global $c;
    $c->set("mot_nome", $obj->mot_nome);
    $c->set("mot_endereco", $obj->mot_endereco);
    $c->set("mot_celular", $obj->mot_celular);
    $c->set("mot_telefone", $obj->mot_telefone);
    $c->set("mot_cpf", $obj->mot_cpf);
    $c->set("mot_rg", $obj->mot_rg);
    $c->set("mot_outros", $obj->mot_outros);
    
    $insert = $c->incluir();

    $msg = $insert ? 'Registro(s) inserido(s) com sucesso' : 'Erro ao inserir o registro, tente novamente.';

    $newData = $obj;
    $newData->id = $insert;

    echo json_encode(array(
        "success" => $insert,
        "message" => $msg,
        "data" => $newData
    ));
}

function update(){
    $obj= (object)$_REQUEST['obj'];

    global $c;
    $c->set("mot_id",$obj->mot_id);
    $c->set("mot_nome", $obj->mot_nome);
    $c->set("mot_endereco", $obj->mot_endereco);
    $c->set("mot_celular", $obj->mot_celular);
    $c->set("mot_telefone", $obj->mot_telefone);
    $c->set("mot_cpf", $obj->mot_cpf);
    $c->set("mot_rg", $obj->mot_rg);
    $c->set("mot_outros", $obj->mot_outros);
    
    $update = $c->alterar();

    $msg = $update ? 'Registro(s) atualizado(s) com sucesso' : 'Erro ao atualizar, tente novamente.';

    echo json_encode(array(
        "success"   => $update,
        "message"   => $msg,
        "data"      => $update
    ));
}


function fetchAll(){
    global $c;
    $result = $c->getTodosRegistros();
    while ( $row = mysql_fetch_assoc( $result ) ) {
        $array[] = array(
            'mot_id'         =>$row['mot_id'],
            'mot_nome'       =>$row['mot_nome'] ? $row['mot_nome']:'',
            'mot_celular'    =>$row['mot_celular'] ? $row['mot_celular']:'',
            'mot_telefone'   =>$row['mot_telefone'] ? $row['mot_telefone']:''
        );
        
    }
    echo json_encode(array(
        "data" => $array,
        "success" => true,
        "total" => mysql_num_rows($result)
    ));
}
        
function buscaId()	{
    $obj= (object)$_REQUEST['obj'];

    global $c;
    $c->set("mot_id", $obj->mot_id);
    $rs = $c->getCadastroId();
    while ( $row = mysql_fetch_assoc( $rs ) ) {
        $resultado[] = array(
            'mot_id'         =>$row['mot_id'],
            'mot_nome'       =>$row['mot_nome'],
            'mot_endereco'   =>$row['mot_endereco'],
            'mot_celular'    =>$row['mot_celular'],
            'mot_telefone'   =>$row['mot_telefone'],
            'mot_cpf'        =>$row['mot_cpf'],
            'mot_rg'         =>$row['mot_rg'],
            'mot_outros'     =>$row['mot_outros']
            
        );
    }
    echo json_encode(array(
        "data" => $resultado,
        "success" => true,
        "total" => mysql_num_rows($rs)
    ));

}