<?php
include '../controler/OpenDB.php';
include '../controler/ColHotel.php';

//set
$c = new ColHotel();

//route
$action = $_REQUEST['action'];
//var_dump($_REQUEST);

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
    $c->set("hot_nome", $obj->hot_nome);
    $c->set("hot_endereco", $obj->hot_endereco);
    $c->set("hot_outros", $obj->hot_outros);
    
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
    $c->set("hot_id",$obj->hot_id);
    $c->set("hot_nome", $obj->hot_nome);
    $c->set("hot_endereco", $obj->hot_endereco);
    $c->set("hot_outros", $obj->hot_outros);
    
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
            'hot_id'        => $row['hot_id'],
            'hot_nome'      => $row['hot_nome']?$row['hot_nome']:''
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
    $c->set("hot_id", $obj->hot_id);
    $rs = $c->getCadastroId();
    while ( $row = mysql_fetch_assoc( $rs ) ) {
        $resultado[] = array(
            'hot_id'        => $row['hot_id'],
            'hot_nome'      => $row['hot_nome'],
            'hot_endereco'  => $row['hot_endereco'],
            'hot_outros'    => $row['hot_outros'],
            
        );
    }
    echo json_encode(array(
        "data" => $resultado,
        "success" => true,
        "total" => mysql_num_rows($rs)
    ));

}