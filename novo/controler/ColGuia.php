<?php

/*
 * Autor: Marcio
 * Revisao: 0
 * Data: 20/11/2013
 *
 * Descricao: 
 * Controle de Acesso na tab_guia
 */

class ColGuia {
    
    private $guia_id;
    private $guia_nome;
    private $guia_endereco;
    private $guia_celular;
    private $guia_telefone;
    private $guia_outros;
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
        $sql = "INSERT INTO tab_guia (
                guia_nome,
                guia_endereco,
                guia_celular,
                guia_telefone,
                guia_outros
                )VALUES(";
        $sql .="'".strtoupper(addslashes($this->guia_nome))."',";
        $sql .="'".strtoupper(addslashes($this->guia_endereco))."',";
        $sql .="'".$this->guia_celular."',";
        $sql .="'".$this->guia_telefone."',";
        $sql .="'".strtoupper(addslashes($this->guia_outros))."'";
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
        
        $sql = "UPDATE tab_guia SET ";
        $sql.="guia_nome ='" . strtoupper(addslashes($this->guia_nome)) . "',";
        $sql.="guia_endereco ='" . strtoupper(addslashes($this->guia_endereco)) . "',";
        $sql.="guia_celular ='" . $this->guia_celular . "',";
        $sql.="guia_telefone ='" . $this->guia_telefone . "',";
        $sql.="guia_outros ='" . strtoupper(addslashes($this->guia_outros)) . "'";
        $sql .=" WHERE guia_id =" . $this->guia_id;

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
        $sql = "DELETE FROM tab_guia WHERE guia_id = " . $this->guia_id;
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
        $sql = "SELECT * FROM tab_guia order by guia_nome";
        $con->set("sql", $sql);
        return $con->execute();
    }

    public function getCadastroId() {
        $con = new cConexao();
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_guia WHERE guia_id =" . $this->guia_id;
        $con->set("sql", $sql);
        return $con->execute();
    }
    
    public function getNomeAutocomplete() {
        $con = new cConexao(); #Cria um novo objeto de conexão com o BD.
        $con->conectar();
        $con->selecionarDB();
        $sql = "SELECT * FROM tab_guia WHERE guia_nome like '".$this->guia_nome."%' order by guia_nome";
        $con->set("sql", $sql);
        return $con->execute();
    }

}