<?php
/*
 * Nesta class esta TODOS os get e set da tab_usuario
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 09/12/2011
 */

class Usuario{
	private $usu_id;
	private $usu_nome;
	private $usu_email;
	private $usu_senha;
	
	public function __construct(){
		
	}
	
	public function getUsuId(){
		return $this->usu_id;
	}
	public function setUsuId($usu_id){
		$this->usu_id = $usu_id;
	}
	
	public function getUsuNome(){
		return $this->usu_nome;
	}
	public function setUsuNome($usu_nome){
		$this->usu_nome = $usu_nome;
	}
	
	public function getUsuEmail(){
		return $this->usu_email;
	}
	public function setUsuEmail($usu_email){
		$this->usu_email = $usu_email;
	}
        
        public function getUsuSenha(){
		return $this->usu_senha;
	}
	public function setUsuSenha($usu_senha){
		$this->usu_senha = $usu_senha;
	}
	
}

?>