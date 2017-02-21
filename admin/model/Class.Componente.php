<?php
/*
 * Nesta class esta TODOS os get e set da tab_proprietario
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 09/12/2011
 */

class Componente	{
	private $idcomponente;
	private $comnome;
	private $comnascimento;
	private $comtelefone;
	private $comcelular;
	private $comendereco;
	private $combairro;
	private $comcep;
	private $comemail;
	private $cominstrumento;
	private $comobservacao;
	private $comfoto;
	private $comstatos;
	
	public function __construct(){
		
	}	
	
	public function getIdComponente(){
		return $this->idcomponente;
	}
	public function setIdComponente($idcomponente){
		$this->idcomponente = $idcomponente;
	}
	
	public function getComNome(){
		return $this->comnome;
	}
	public function setComNome($comnome){
		$this->comnome = $comnome;
	}
	
	public function getComNascimento(){
		return $this->comnascimento;
	}
	public function setComNascimento($comnascimento){
		$this->comnascimento = $comnascimento;
	}
	
	public function getComTelefone(){
		return $this->comtelefone;
	}
	public function setComTelefone($comtelefone){
		$this->comtelefone = $comtelefone;
	}
	
	public function getComCelular(){
		return $this->comcelular;
	}
	public function setComCelular($comcelular){
		$this->comcelular = $comcelular;
	}
	
	public function getComEndereco(){
		return $this->comendereco;
	}
	public function setComEndereco($comendereco){
		$this->comendereco = $comendereco;
	}
        
    public function getComBairro(){
		return $this->combairro;
	}
	public function setComBairro($combairro){
		$this->combairro = $combairro;
	}
        
    public function getComCep(){
		return $this->comcep;
	}
	public function setComCep($comcep){
		$this->comcep = $comcep;
	}
	
	public function getComEmail(){
		return $this->comemail;
	}
	public function setComEmail($comemail){
		$this->comemail = $comemail;
	}
	
	public function getComInstrumento(){
		return $this->cominstrumento;
	}
	public function setComInstrumento($cominstrumento){
		$this->cominstrumento = $cominstrumento;
	}
	
	public function getComObservacao(){
		return $this->comobservacao;
	}
	public function setComObservacao($comobservacao){
		$this->comobservacao = $comobservacao;
	}
	
	public function getComFoto(){
		return $this->comfoto;
	}
	public function setComFoto($comfoto){
		$this->comfoto = $comfoto;
	}
	
	public function getComStatos(){
		return $this->comstatos;
	}
	public function setComStatos($comstatos){
		$this->comstatos = $comstatos;
	}
}
?>