<?php

/*
 * Autor: Marcio
 * Revisao: 0
 * Data: 20/11/2013
 *
 * Descricao: 
 * Controle de Acesso na tab_hotel
 */

class ColMotorista {

    private $mot_id;
    private $mot_nome;
    private $mot_endereco;
    private $mot_celular;
    private $mot_telefone;
    private $mot_cpf;
    private $mot_rg;
    private $mot_outros;
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
        $sql = "INSERT INTO tab_motorista (
                    mot_nome,
                    mot_endereco,
                    mot_celular,
                    mot_telefone,
                    mot_cpf,
                    mot_rg,
                    mot_outros
                ) VALUES (";
        $sql .="'" . strtoupper(addslashes($this->mot_nome)) . "',";
        $sql .="'" . strtoupper(addslashes($this->mot_endereco)) . "',";
        $sql .="'" . $this->mot_celular . "',";
        $sql .="'" . $this->mot_telefone . "',";
        $sql .="'" . $this->mot_cpf . "',";
        $sql .="'" . $this->mot_rg . "',";
        $sql .="'" . strtoupper(addslashes($this->mot_outros)) . "'";
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
        $sql = "UPDATE tab_motorista set ";
        $sql .="mot_nome='" . strtoupper(addslashes($this->mot_nome)) . "',";
        $sql .="mot_endereco='" . strtoupper(addslashes($this->mot_endereco)) . "',";
        $sql .="mot_celular='" . $this->mot_celular . "',";
        $sql .="mot_telefone='" . $this->mot_telefone . "',";
        $sql .="mot_cpf='" . $this->mot_cpf . "',";
        $sql .="mot_rg='" . $this->mot_rg . "',";
        $sql .="mot_outros='" . strtoupper(addslashes($this->mot_outros)) . "'";
        $sql .=" WHERE mot_id=" . $this->mot_id;
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
        $sql = "DELETE FROM tab_motorista WHERE mot_id = " . $this->mot_id;
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
        $sql = "SELECT * FROM tab_motorista order by mot_nome";
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function getCadastroId() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_motorista WHERE mot_id =" . $this->mot_id;
        $con->set("sql", $sql);
        return $con->execute();
    }

}