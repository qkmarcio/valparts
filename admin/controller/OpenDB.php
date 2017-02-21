<?php
/* Este arquivo conecta um banco de dados MySQL
 * Na function conectar() apontar para qual servido você deseja se conectar
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 09/12/2011
 */

class OpenDB{	
	private $dbname; // Indique o nome do banco de dados que será aberto
	private $usuario; // Indique o nome do usuário que tem acesso
	private $senha; // Indique a senha do usuário
	private $conexao;
	
	public function __construct(){
                //$this->setDbName("orquestr_remoto");
		$this->setDbName("sena");
		@session_start('login');
	}
	
	public function setUsuario($user){
		$this->usuario=$user;
	}
	public function setSenha($senha){
		$this->senha=$senha;
	}
	public function setDbName($nome){
		$this->dbname = $nome;
	}
	public function getUsuario(){
		return $this->usuario;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function getDbName(){
		return $this->dbname;
	}
	
	public function conectar(){	
		//1 passo - Conecta ao servidor MySQL
		@mysql_connect(@$_SESSION['servidor'],$this->getUsuario(),$this->getSenha());
                $status = mysql_error();
                
                if( !strcmp($status,"") == 0){
                    @$_SESSION["conectado"]='nao';
                    return false;
                }
                else{
                    @mysql_select_db($this->getDbName());
                    $status = mysql_error();
                    if( !strcmp($status,"") == 0){
                        @$_SESSION["conectado"]='nao';
                        return false;
                    }
                    else{
                        @$_SESSION["conectado"]='sim';
                        @$_SESSION["usuario"]=$this->getUsuario();
                        @$_SESSION["senha"]=$this->getSenha();
                        return true;
                    }
                }                
	}	
        
        public function conectarNovamente($usuario,$senha){	
		/* SOBRECARGA DE METODO CASO JÁ ESTEJA LOGADO
                 * PARA NOVAS CONSULTAS EM BANCO
                 */
		if(!($conexao = mysql_connect(@$_SESSION['servidor'],$usuario,$senha) )){
                    @$_SESSION["conectado"]='nao';
                    header( 'Location: ../index.php' );
		}			
		//2 passo - Seleciona o Banco de Dados
                //else if( !(mysql_select_db("orquestr_remoto") ) ) {
		else if( !(mysql_select_db("sena") ) ) {
                    @$_SESSION["conectado"]='nao';
                    header( 'Location: ../index.php');		   
		}
		
		return true;
	}
}
?>