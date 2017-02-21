<?php

/*
 * Autor: Marcio
 * Revisao: 0
 * Data: 20/11/2013
 *
 * Descricao: 
 * Controle de Acesso na tab_hotel
 */

class ColHotel {

    private $hot_id;
    private $hot_nome;
    private $hot_endereco;
    private $hot_outros;
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
        $sql = "INSERT INTO tab_hotel (
                hot_nome,
                hot_endereco,
                hot_outros
            )VALUES(";
        $sql .="'" . strtoupper(addslashes($this->hot_nome)) . "',";
        $sql .="'" . strtoupper(addslashes($this->hot_endereco)) . "',";
        $sql .="'" . strtoupper(addslashes($this->hot_endereco)) . "'";
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
        $sql = "UPDATE tab_hotel set ";
        $sql .="hot_nome='" . strtoupper(addslashes($this->hot_nome)) . "',";
        $sql .="hot_endereco='" . strtoupper(addslashes($this->hot_endereco)) . "',";
        $sql .="hot_outros='" . strtoupper(addslashes($this->hot_outros)) . "'";
        $sql .=" WHERE hot_id=" . $this->hot_id;
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
        $sql = "DELETE FROM tab_hotel WHERE hot_id = " . $this->hot_id;
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
        $sql = "SELECT * FROM tab_hotel order by hot_nome";
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function getCadastroId() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_hotel WHERE hot_id =" . $this->hot_id;
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function temRegistro() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_hotel WHERE hot_nome =" . $this->hot_nome;
        $con->set("sql", $sql);
        $linhas = $con->execute();
        if (mysql_num_rows($linhas) >= 1) {
            return true;
        } else {
            return false;
        }
    }

}