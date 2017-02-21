<?php
include '../controler/OpenDB.php';
include '../controler/ColGrupo.php';
include '../lib/formatador.php';

//require_once '../controler/Util.php';
//require_once '../lib/Formatador.php';

/**
 * Classe para efetuar login no sistema
 */

//set
$c = new ColCliente();

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
    $c->set("clie_nome", $obj->nome);
    $c->set("clie_quantidade", $obj->quantidade);
    $c->set("guia_id", $obj->guiaId);
    $c->set("clie_voo", $obj->voo);
    $c->set("clie_data_voo", Formatador::dataBrMysql($obj->dtVoo));
    $c->set("clie_hora_voo", $obj->hrVoo);
    $c->set("hot_id", $obj->hotelId);
    $c->set("clie_entrada_hotel", Formatador::dataBrMysql($obj->hotEntrada));
    $c->set("clie_saida_hotel", Formatador::dataBrMysql($obj->hotSaida));
    $c->set("clie_descricao_reserva", $obj->obsReserva);
    $c->set("clie_programacao", $obj->programacao);
    
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
    $c->set("clie_id", $obj->id);
    $c->set("clie_nome", $obj->nome);
    $c->set("clie_quantidade", $obj->quantidade);
    $c->set("guia_id", $obj->guiaId);
    $c->set("clie_voo", $obj->voo);
    $c->set("clie_data_voo", Formatador::dataBrMysql($obj->dtVoo));
    $c->set("clie_hora_voo", $obj->hrVoo);
    $c->set("hot_id", $obj->hotelId);
    $c->set("clie_entrada_hotel", Formatador::dataBrMysql($obj->hotEntrada));
    $c->set("clie_saida_hotel", Formatador::dataBrMysql($obj->hotSaida));
    $c->set("clie_descricao_reserva", $obj->obsReserva);
    $c->set("clie_programacao", $obj->programacao);
    
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
    $result = $c->getTodosRegistros('clie_nome');
    while ( $row = mysql_fetch_assoc( $result ) ) {
        $array[] = array(
            'id'            =>$row['clie_id'],
            'Nome Pax'      =>$row['clie_nome'],
            //'Guia'          =>$row['guia_nome'],
            'Quant.'        =>$row['clie_quantidade'],
            'Nº Voo'        =>$row['clie_voo'],
            'Chegada Voo'   =>Formatador::dataMysqlBr($row['clie_data_voo']).'<br>'.$row['clie_hora_voo'],
            //'Hotel'         =>$row['hot_nome'],
            'Entrada'       =>Formatador::dataMysqlBr($row['clie_entrada_hotel']),
            'Saida'         =>Formatador::dataMysqlBr($row['clie_saida_hotel']),
            'obsReserva'    =>$row['clie_descricao_reserva'],
            'Roteiro'       =>$row['clie_programacao']
        );
        
    }
    echo json_encode(array(
        "data" => $array,
        "success" => true,
        "total" => mysql_num_rows($result)
    ));
}

function getInicio(){
    global $c;
    $result = $c->getTodosRegistros('clie_data_voo');
    while ( $row = mysql_fetch_assoc( $result ) ) {
        $array[] = array(
            'id'            =>$row['clie_id'],
            'chegada'       =>Formatador::dataMysqlBr($row['clie_entrada_hotel']),
            'Nome Pax'         =>$row['clie_nome'],
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
    $c->set("clie_id", $obj->id);
    $rs = $c->getCadastroId();
    while ( $row = mysql_fetch_assoc( $rs ) ) {
        $resultado[] = array(
            'id'            =>$row['clie_id'],
            'nome'          =>$row['clie_nome'],
            'guiaId'        =>$row['guia_id'],
            'quantidade'    =>$row['clie_quantidade'],
            'voo'           =>$row['clie_voo'],
            'dtVoo'         =>Formatador::dataMysqlBr($row['clie_data_voo']),
            'hrVoo'         =>Formatador::dataMysqlBr($row['clie_hora_voo']),
            'hotelId'       =>$row['hot_id'],
            'hotEntrada'    =>Formatador::dataMysqlBr($row['clie_entrada_hotel']),
            'hotSaida'      =>Formatador::dataMysqlBr($row['clie_saida_hotel']),
            'obsReserva'    =>$row['clie_descricao_reserva'],
            'programacao'   =>$row['clie_programacao']
            
        );
    }
    echo json_encode(array(
        "data" => $resultado,
        "success" => true,
        "total" => mysql_num_rows($rs)
    ));

}
        
        function getAniverPorMes()	{
            $data= (object)$_REQUEST['obj'];
            
            global $c;
            $rs = $c->getListaPorMes($data->mes);
            while ( $row = mysql_fetch_assoc( $rs ) ) {
                $resultado[] = array(
                    'jov_id'            => $row['jov_id'],
                    'jov_nome'          => $row['jov_nome'],
                    'jov_aniversario'   => Formatador::dateEmPortugues($row['jov_aniversario']),
                    'jov_celular'       => $row['jov_celular'],
                    'jov_telefone'      => $row['jov_telefone'],
                    'jov_outros'        => $row['jov_outros'],
                    'jov_email'         => strtolower($row['jov_email']),
                    'jov_endereco'      => $row['jov_endereco'],
                    'jov_bairro'        => $row['jov_bairro'],
                    'jov_complemento'   => $row['jov_complemento'],
                    'jov_status'        => $row['jov_status']
                );
            }
            echo json_encode(array(
                "data" => $resultado,
                "success" => true,
                "total" => mysql_num_rows($rs)
            ));

	}

	

	

	function delete(){
            $data = json_decode($_REQUEST['data']);

            global $c;
                $c->set("for_id", $data->for_id);
                $formularioExcluido = $c->remover();

                $msg = $formularioExcluido ? 'Registro(s) excluído(s) com sucesso' : 'Erro ao excluir, tente novamente.';

                echo json_encode(array(
                    "success" => $formularioExcluido,
                    "message" => $msg
                ));
	}