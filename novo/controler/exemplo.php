<?php

/*
 * Autor: Marcio
 * Revisao: 0
 * Data: 20/11/2013
 *
 * Descricao: 
 * Controle de Acesso na tab_hotel
 */

class ColGrupo {
    
    private $gru_id;
    private $mot_id;
    private $guia_id;
    private $hot_id;
    private $gru_nome;
    private $gru_hotel_detalhes;
    private $gru_nome_paxs;
    private $gru_placa;
    private $gru_veiculo;
    private $gru_coordenador;
    private $gru_entinerario;
    private $erro;
    private $dica;

    //#atribuir valores as propriedades da classe;

    public function set($prop, $value) {
        $this->$prop = $value;
    }

    public function get($prop) {
        return $this->$prop;
    }

    public function incluir() {
        $con = new cConexao(); // Cria um novo objeto de conexão com o BD. 
        $con->conectar();
        $con->selecionarDB();
        $sql = "INSERT INTO tab_grupo (
                    mot_id,
                    guia_id,
                    hot_id,
                    gru_nome,
                    gru_hotel_detalhes,
                    gru_nome_paxs,
                    gru_placa,
                    gru_veiculo,
                    gru_coordenador,
                    gru_entinerario
                )VALUES(";
        $sql .="".$this->mot_id.",";
        $sql .="".$this->guia_id.",";
        $sql .="".$this->hot_id.",";
        $sql .="'".strtoupper(addslashes($this->gru_nome))."',";
        $sql .="'".strtoupper(addslashes($this->gru_hotel_detalhes))."',";
        $sql .="'".strtoupper(addslashes($this->gru_nome_paxs))."',";
        $sql .="'".strtoupper(addslashes($this->gru_placa))."',";
        $sql .="'".strtoupper(addslashes($this->gru_veiculo))."',";
        $sql .="'".strtoupper(addslashes($this->gru_coordenador))."',";
        $sql .="'".strtoupper(addslashes($this->gru_entinerario))."'";
        $sql .=")";

        $con->set("sql", $sql);
        if ($con->execute()) {
            $id = $con->ultimoId;
            return $id;
        } else {
            $this->erro = $con->erro;
            return false;
        }
    }

    public function alterar() {
        $con = new cConexao(); // Cria um novo objeto de conexão com o BD. 
        $con->conectar();
        $con->selecionarDB();
        
        $sql ="UPDATE tab_grupo SET ";
        $sql .="mot_id=".$this->mot_id.",";
        $sql .="guia_id=".$this->guia_id.",";
        $sql .="hot_id=".$this->hot_id.",";
        $sql .="gru_nome='".strtoupper(addslashes($this->gru_nome))."',";
        $sql .="gru_hotel_detalhes='".strtoupper(addslashes($this->gru_hotel_detalhes))."',";
        $sql .="gru_nome_paxs='".strtoupper(addslashes($this->gru_nome_paxs))."',";
        $sql .="gru_placa='".strtoupper(addslashes($this->gru_placa))."',";
        $sql .="gru_veiculo='".strtoupper(addslashes($this->gru_veiculo))."',";
        $sql .="gru_coordenador='".strtoupper(addslashes($this->gru_coordenador))."',";
        $sql .="gru_entinerario='".strtoupper(addslashes($this->gru_entinerario))."'";
        $sql .="WHERE `gru_id=".$this->gru_id;

        $con->set("sql", $sql);
        if ($con->execute()) {
            return true;
        } else {
            $this->erro = $con->erro;
            return false;
        }
    }

    #remove o registro

    public function remover() {
        $con = new cConexao(); // Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "DELETE FROM tab_grupo WHERE gru_id = " . $this->gru_id;
        $con->set("sql", $sql);
        $resultado = $con->execute();
        if ($resultado) {
            return $con->execute();
        } else {
            return false;
        }
    }

    public function getTodosRegistros($ordem) {
        $con = new cConexao(); // Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_grupo order by ".$ordem; 
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function getCadastroId() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_grupo WHERE gru_id =" . $this->gru_id;
        $con->set("sql", $sql);
        return $con->execute();
    }

}