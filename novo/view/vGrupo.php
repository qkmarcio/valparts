<?php
include '../controler/OpenDB.php';
include '../controler/ColGrupo.php';
include_once '../controler/ColPassageiro.php';
include '../lib/formatador.php';

//set
$c = new ColGrupo();
$colPassageiro = new ColPassageiro();
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
    
    $c->set("mot_id", $obj->mot_id);
    $c->set("guia_id", $obj->guia_id);
    $c->set("hot_id", $obj->hot_id);
    $c->set("gru_nome", $obj->gru_nome);
    $c->set("gru_hot_entrada", Formatador::dataBrMysql($obj->gru_hot_entrada));
    $c->set("gru_hot_saida", Formatador::dataBrMysql($obj->gru_hot_saida));
    $c->set("gru_hotel_detalhes", $obj->gru_hotel_detalhes);
    $c->set("gru_nome_paxs", $obj->gru_nome_paxs);
    $c->set("gru_placa", $obj->gru_placa);
    $c->set("gru_veiculo", $obj->gru_veiculo);
    $c->set("gru_coordenador", $obj->gru_coordenador);
    $c->set("gru_entinerario", $obj->gru_entinerario);
    
    $insert = $c->incluir();
    
    // CONSULTA LAST_INSERD_ID NO BANCO
    $r = mysql_query("select last_insert_id() as gru_id");
    $objetoR = mysql_fetch_object($r);
    $gru_id = $objetoR->gru_id;
    
    for ($index = 0; $index < count($obj->arrayIntegrantes ); $index++) {
        $o = (object) $obj->arrayIntegrantes[$index];
        global $colPassageiro;
        $colPassageiro->set("gru_id", $gru_id); // gru_id vem do last_insert_id
        $colPassageiro->set("pas_nome", $o->pas_nome);
        $colPassageiro->set("pas_nascimento", $o->pas_nascimento);
        $colPassageiro->set("pas_documento", $o->pas_documento);
        $colPassageiro->set("mov_tipoIn", $o->mov_tipoIn);
        $colPassageiro->set("mov_transporteIn", $o->mov_transporteIn);
        $colPassageiro->set("mov_dataIn", $o->mov_dataIn);
        $colPassageiro->set("mov_tipoOut", $o->mov_tipoOut);
        $colPassageiro->set("mov_transporteOut", $o->mov_transporteOut);
        $colPassageiro->set("mov_dataOut", $o->mov_dataOut);
        $colPassageiro->incluir();
    }

    $msg = $insert ? 'Registro(s) inserido(s) com sucesso' : 'Erro ao inserir o registro, tente novamente.';

    $newData = $obj;
    $newData->gur_id = $insert;

    echo json_encode(array(
        "success" => $insert,
        "message" => $msg,
        "data" => $newData
    ));
}

function update(){
    $obj= (object)$_REQUEST['obj'];

    global $c;
    $c->set("mot_id", $obj->mot_id);
    $c->set("guia_id", $obj->guia_id);
    $c->set("hot_id", $obj->hot_id);
    $c->set("gru_nome", $obj->gru_nome);
    $c->set("gru_hot_entrada", Formatador::dataBrMysql($obj->gru_hot_entrada));
    $c->set("gru_hot_saida", Formatador::dataBrMysql($obj->gru_hot_saida));
    $c->set("gru_hotel_detalhes", $obj->gru_hotel_detalhes);
    $c->set("gru_nome_paxs", $obj->gru_nome_paxs);
    $c->set("gru_placa", $obj->gru_placa);
    $c->set("gru_veiculo", $obj->gru_veiculo);
    $c->set("gru_coordenador", $obj->gru_coordenador);
    $c->set("gru_entinerario", $obj->gru_entinerario);
    
    $update = $c->alterar();

    $msg = $update ? 'Registro(s) atualizado(s) com sucesso' : 'Erro ao atualizar, tente novamente.';

    echo json_encode(array(
        "success"   => $update,
        "message"   => $msg,
        "data"      => $update
    ));
}

function fetchAll(){
    $obj= (object)$_REQUEST['obj'];
    global $c;
    $c->set("gru_nome", $obj->gru_nome);
    $result = $c->getTodosRegistros();
    while ( $row = mysql_fetch_assoc( $result ) ) {
        $array[] = array(
            'gru_id'                =>$row['gru_id'],
            'mot_id'                =>$row['mot_id'],
            'guia_id'               =>$row['guia_id'],
            'hot_id'                =>$row['hot_id'],
            'gru_nome'              =>$row['gru_nome'],
            'gru_hot_entrada'       =>Formatador::dataMysqlBr($row['gru_hot_entrada']),
            'gru_hot_saida'         =>Formatador::dataMysqlBr($row['gru_hot_saida']),
            'gru_hotel_detalhes'    =>$row['gru_hotel_detalhes'],
            'gru_nome_paxs'         =>$row['gru_nome_paxs'],
            'gru_placa'             =>$row['gru_placa'],
            'gru_veiculo'           =>$row['gru_veiculo'],
            'gru_coordenador'       =>$row['gru_coordenador'],
            'gru_entinerario'       =>$row['gru_entinerario'],
            
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
    $c->set("gru_id", $obj->gru_id);
    $rs = $c->getCadastroId();
    while ( $row = mysql_fetch_assoc( $rs ) ) {
        $resultado[] = array(
            'gru_id'                =>$row['gru_id'],
            'mot_id'                =>$row['mot_id'],
            'guia_id'               =>$row['guia_id'],
            'hot_id'                =>$row['hot_id'],
            'gru_nome'              =>$row['gru_nome'],
            'gru_hot_entrada'       =>Formatador::dataMysqlBr($row['gru_hot_entrada']),
            'gru_hot_saida'         =>Formatador::dataMysqlBr($row['gru_hot_saida']),
            'gru_hotel_detalhes'    =>$row['gru_hotel_detalhes'],
            'gru_nome_paxs'         =>$row['gru_nome_paxs'],
            'gru_placa'             =>$row['gru_placa'],
            'gru_veiculo'           =>$row['gru_veiculo'],
            'gru_coordenador'       =>$row['gru_coordenador'],
            'gru_entinerario'       =>$row['gru_entinerario']
        );
    }
    echo json_encode(array(
        "data" => $resultado,
        "success" => true,
        "total" => mysql_num_rows($rs)
    ));

}