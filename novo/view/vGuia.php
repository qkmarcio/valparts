<?php
include '../controler/OpenDB.php';
include '../controler/ColGuia.php';

//set
$c = new ColGuia();

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
    $c->set("guia_nome", $obj->guia_nome);
    $c->set("guia_endereco", $obj->guia_endereco);
    $c->set("guia_celular", $obj->guia_celular);
    $c->set("guia_telefone", $obj->guia_telefone);
    $c->set("guia_outros", $obj->guia_outros);
    
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
    $c->set("guia_id",$obj->guia_id);
    $c->set("guia_nome", $obj->guia_nome);
    $c->set("guia_endereco", $obj->guia_endereco);
    $c->set("guia_celular", $obj->guia_celular);
    $c->set("guia_telefone", $obj->guia_telefone);
    $c->set("guia_outros", $obj->guia_outros);
    
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
            'guia_id'         =>$row['guia_id'],
            'guia_nome'       =>$row['guia_nome']?$row['guia_nome']:'',
            'guia_endereco'   =>$row['guia_endereco']?$row['guia_endereco']:'',
            'guia_celular'    =>$row['guia_celular']?$row['guia_celular']:'',
            'guia_telefone'   =>$row['guia_telefone']?$row['guia_telefone']:'',
            'guia_outros'     =>$row['guia_outros']?$row['guia_outros']:''
        );
        
    }
    echo json_encode(array(
        "data" => $array,
        "success" => true,
        "total" => mysql_num_rows($result)
    ));
}
        
function buscaId(){
    $obj= (object)$_REQUEST['obj'];

    global $c;
    $c->set("guia_id", $obj->guia_id);
    $rs = $c->getCadastroId();
    while ( $row = mysql_fetch_assoc( $rs ) ) {
        $resultado[] = array(
            'guia_id'         =>$row['guia_id'],
            'guia_nome'       =>$row['guia_nome'],
            'guia_endereco'   =>$row['guia_endereco'],
            'guia_celular'    =>$row['guia_celular'],
            'guia_telefone'   =>$row['guia_telefone'],
            'guia_outros'     =>$row['guia_outros']
            
        );
    }
    echo json_encode(array(
        "data" => $resultado,
        "success" => true,
        "total" => mysql_num_rows($rs)
    ));

}

function buscaNome(){
    $obj= (object)$_REQUEST['obj'];

    global $c;
    $c->set("guia_nome", $obj->letra);
    $rs = $c->getNomeAutocomplete();
    while ( $row = mysql_fetch_assoc( $rs ) ) {
        $resultado[] =$row;
    }
    echo json_encode($resultado);

}