<?php

/*
 * Autor: Marcio
 * Revisao: 0
 * Data: 20/11/2013
 *
 * Descricao: 
 * Controle de Acesso na tab_passageiro
 */

class ColPassageiro {

    private $pas_id;
    private $gru_id;
    private $pas_nome;
    private $pas_nascimento;
    private $pas_documento;
    private $mov_tipoIn;
    private $mov_transporteIn;
    private $mov_dataIn;
    private $mov_tipoOut;
    private $mov_transporteOut;
    private $mov_dataOut;
    
    
    

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
        $sql = "INSERT INTO tab_passageiro (                    
                    `gru_id`,
                    `pas_nome`,
                    `pas_nascimento`,
                    `pas_documento`,
                    `mov_tipoIn`,
                    `mov_transporteIn`,
                    `mov_dataIn`,
                    `mov_tipoOut`,
                    `mov_transporteOut`,
                    `mov_dataOut`) VALUES (";
        $sql .="" . $this->gru_id . ",";
        $sql .="'" . strtoupper(addslashes($this->pas_nome)) . "',";
        $sql .="'" . $this->pas_nascimento . "',";
        $sql .="'" . strtoupper(addslashes($this->pas_documento)) . "',";
        $sql .="'" . strtoupper(addslashes($this->mov_tipoIn)) . "',";
        $sql .="'" . strtoupper(addslashes($this->mov_transporteIn)) . "',";
        $sql .="'" . strtoupper(addslashes($this->mov_dataIn)) . "',";
        $sql .="'" . strtoupper(addslashes($this->mov_tipoOut)) . "',";
        $sql .="'" . strtoupper(addslashes($this->mov_transporteOut)) . "',";
        $sql .="'" . strtoupper(addslashes($this->mov_dataOut)) . "'";
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
        $sql = "UPDATE tab_passageiro set ";
        $sql .="gru_id='" .$this->gru_id . "',";
        $sql .="pas_nome='" . strtoupper(addslashes($this->pas_nome)) . "',";
        $sql .="pas_nascimento='" . $this->pas_nascimento . "',";
        $sql .="pas_documento='" . strtoupper(addslashes($this->pas_documento)) . "'";
        $sql .=" WHERE pas_id=" . $this->pas_id;
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
        $sql = "DELETE FROM tab_passageiro WHERE pas_id = " . $this->pas_id;
        $con->set("sql", $sql);
        $resultado = $con->execute();
        if ($resultado) {
            return $con->execute();
        } else {
            return false;
        }
    }

    public function getTodosRegistros() {
        $con = new cConexao(); // Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_passageiro order by pas_nome";
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function getCadastroId() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_passageiro WHERE pas_id =" . $this->pas_id;
        $con->set("sql", $sql);
        return $con->execute();
    }

}