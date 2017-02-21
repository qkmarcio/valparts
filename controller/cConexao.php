<?php

/* Este arquivo conecta um banco de dados MySQL
 * Na function conectar() apontar para qual servido você deseja se conectar
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 30/11/2016
 */
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);

class cConexao {
    
    public $host = "127.0.0.1";
    public $user = "root";
    public $pass = "";
    public $db = "valparts";
    public $ultimoId;
    public $erro;

    #conecta no banco de dados;

    function conectar() {
        $con = mysql_connect($this->host, $this->user, $this->pass) or die($this->erro(mysql_error()));
        return $con;
    }

    #seleciona o banco de dados a ser trabalhado, se encontrar o banco retorna true caso contrario false;

    function selecionarDB() {
        $sel = mysql_select_db($this->db) or die(mysql_error());
        if ($sel) {
            return true;
        } else {
            return false;
        }
    }

    #executa funções no banco retorna como padrão um objeto a ser tratado;

    function execute() {
        $qry = mysql_query($this->sql) or die(mysql_error() . " " . $this->sql);
        $this->ultimoId = mysql_insert_id();
        return $qry;
    }

    #atribuir valores as propriedades da classe;	

    function set($prop, $value) {
        $this->$prop = $value;
    }

    function get($prop) {
        return $this->$prop;
    }
    
    function
        conFirebird($charset = null, $buffers = null) {
        $servidor = '192.168.0.10:E:/DADOS/BD/DBSC.VJM'; //Marcio
        //$servidor = 'localhost:C:/SCPY/dbsc/DBSC.VJM'; //Marcio
        $conn = ibase_connect($servidor, 'SYSDBA', 'masterkey', $charset, $buffers);
        if ($conn) {
            return $conn;
        } else {
            die('Erro ao conectar: ' . ibase_errmsg());
        }
    }

}