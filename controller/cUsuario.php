<?php

/*
 * Autor: Marcio
 * Revisao: 0
 * Data: 20/11/2013
 *
 * Descricao: 
 * Controle de Acesso na tab_guia
 */

class cUsuario {
    
    private $usu_id;
    private $usu_nome;
    private $usu_login;
    private $usu_senha;
    private $usu_status;
    private $erro;
    private $dica;

   #atribuir valores as propriedades da classe;

    public function set($prop, $value) {
        $this->$prop = $value;
    }

    public function get($prop) {
        return $this->$prop;
    }

    public function incluir() {
        $con = new cConexao();  #Cria um novo objeto de conexão com o BD. 
        $con->conectar();
        $con->selecionarDB();
        $sql = "INSERT INTO tab_usuario (
                usu_nome,
                usu_login,
                usu_senha,
                usu_status
                )VALUES(";
        $sql .="'".strtoupper(addslashes($this->usu_nome))."',";
        $sql .="'".strtoupper(addslashes($this->usu_login))."',";
        $sql .="'".md5($this->usu_senha)."',";
        $sql .="'".strtoupper(addslashes($this->usu_status))."'";
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
        $con = new cConexao(); #Cria um novo objeto de conexão com o BD. 
        $con->conectar();
        $con->selecionarDB();
        
        $sql = "UPDATE tab_usuario SET ";
        $sql.="usu_nome ='" . strtoupper(addslashes($this->usu_nome)) . "',";
        $sql.="usu_login ='" . strtoupper(addslashes($this->usu_login)) . "',";
        $sql.="usu_senha ='" . md5($this->usu_senha) . "',";
        $sql.="usu_status ='" . strtoupper(addslashes($this->usu_status)) . "'";
        $sql .=" WHERE usu_id =" . $this->usu_id;

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
        $con = new cConexao(); #Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "DELETE FROM tab_usuario WHERE usuario_id = " . $this->usu_id;
        $con->set("sql", $sql);
        $resultado = $con->execute();
        if ($resultado) {
            return $con->execute();
        } else {
            return false;
        }
    }

    public function getTodosRegistros() {
        $con = new cConexao(); #Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_usuario order by usu_nome";
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function getCadastroId() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_usuario WHERE usu_id =" . $this->usu_id;
        $con->set("sql", $sql);
        return $con->execute();
    }
    
    public function getNomeAutocomplete() {
        $con = new cConexao(); #Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_usuario WHERE usu_nome like '".$this->usu_nome."%' order by usu_nome";
        $con->set("sql", $sql);
        return $con->execute();
    }
    
    public function getLogar($usuario,$senha){
        $con = new cConexao(); #Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_usuario WHERE usu_login='".strtoupper(addslashes($usuario))."' and usu_senha='$senha' ";
        $con->set("sql", $sql);
        return $con->execute();
        

    }

}