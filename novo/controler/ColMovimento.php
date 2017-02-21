<?php

/*
 * Autor: Marcio
 * Revisao: 0
 * Data: 20/11/2013
 *
 * Descricao: 
 * Controle de Acesso na tab_movimento
 */

class ColMovimento {

    private $mov_id;
    private $pas_id;
    private $mov_data;
    private $mov_tipo;
    private $mov_transporte;
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
        $sql = "INSERT INTO tab_movimento (
                    pas_id,
                    mov_data,
                    mov_tipo,
                    mov_transporte,
                ) VALUES (";
        $sql .="" .$this->pas_id . ",";
        $sql .="'" . $this->mov_data . "',";
        $sql .="'" . strtoupper(addslashes($$this->mov_tipo)) . "',";
        $sql .="'" . strtoupper(addslashes($$this->mov_transporte)) . "',";
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
        $sql = "UPDATE tab_movimento set ";
        $sql .="pas_id=" . $this->pas_id . ",";
        $sql .="mov_data='" . $this->mov_data . "',";
        $sql .="mov_tipo='" . strtoupper(addslashes($this->mov_tipo)) . "',";
        $sql .="mov_transporte='" . strtoupper(addslashes($this->mov_transporte)) . "',";
        $sql .=" WHERE mov_id=" . $this->mov_id;
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
        $sql = "DELETE FROM tab_movimento WHERE mov_id = " . $this->mov_id;
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
        $sql = "SELECT * FROM tab_movimento order by mov_data";
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function getCadastroId() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_movimento WHERE mov_id =" . $this->mov_id;
        $con->set("sql", $sql);
        return $con->execute();
    }

}