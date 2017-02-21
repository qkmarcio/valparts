<?php
/*
 * Nesta class esta TODOS os get e set da tab_loja
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 04/09/2012
 */

class Loja{
	private $loja_id;
        private $loj_categoria;
	private $loj_nome;
        private $loj_preco;
        private $loj_desconto;
        private $loj_descricao;
        private $loj_principal;
        private $loj_foto;
        private $loja_categoria_id;
        private $loja_cat_nome;
        
	public function __construct(){
		
	}
	
	public function getLojaId(){
		return $this->loja_id;
	}
	public function setLojaId($loja_id){
		$this->loja_id = $loja_id;
	}
        
        public function getLojCategoria(){
		return $this->loj_categoria;
	}
	public function setLojCategoria($loj_categoria){
		$this->loj_categoria = $loj_categoria;
	}
	
	public function getLojNome(){
		return $this->loj_nome;
	}
	public function setLojNome($loj_nome){
		$this->loj_nome = $loj_nome;
	}
	
	public function getLojPreco(){
		return $this->loj_preco;
	}
	public function setLojPreco($loj_preco){
		$this->loj_preco = $loj_preco;
	}
        
        public function getLojDesconto(){
		return $this->loj_desconto;
	}
	public function setLojDesconto($loj_desconto){
		$this->loj_desconto = $loj_desconto;
	}
        
        public function getLojDescricao(){
		return $this->loj_descricao;
	}
	public function setLojDescricao($loj_descricao){
		$this->loj_descricao = $loj_descricao;
	}
        
        public function getLojPrincipal(){
		return $this->loj_principal;
	}
	public function setLojPrincipal($loj_principal){
		$this->loj_principal = $loj_principal;
	}
        
        public function getLojFoto(){
		return $this->loj_foto;
	}
	public function setLojFoto($loj_foto){
		$this->loj_foto = $loj_foto;
	}
        
        public function getLojaCategoriaId(){
		return $this->loja_categoria_id;
	}
	public function setLojaCategoriaId($loja_categoria_id){
		$this->loja_categoria_id = $loja_categoria_id;
	}
        
        public function getLojaCatNome(){
		return $this->loja_cat_nome;
	}
	public function setLojaCatNome($loja_cat_nome){
		$this->loja_cat_nome = $loja_cat_nome;
	}
        
}

?>