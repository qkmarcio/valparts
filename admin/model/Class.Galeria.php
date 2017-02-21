<?php
/*
 * Nesta class esta TODOS os get e set da tab_usuario
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 09/12/2011
 */

class Galeria{
	private $video_id;
	private $vid_categoria;
        private $vid_titulo;
        private $vid_thumb;
        private $vid_descricao;
        private $vid_embed;
        private $categoria_id;
        private $cat_nome;
	
	public function __construct(){
		
	}
	
	public function getVideoId(){
		return $this->video_id;
	}
	public function setVideoId($video_id){
		$this->video_id = $video_id;
	}
	
	public function getVidCategoria(){
		return $this->vid_categoria;
	}
	public function setVidCategoria($vid_categoria){
		$this->vid_categoria = $vid_categoria;
	}
	
	public function getVidTitulo(){
		return $this->vid_titulo;
	}
	public function setVidTitulo($vid_titulo){
		$this->vid_titulo = $vid_titulo;
	}
        
        public function getVidThumb(){
		return $this->vid_thumb;
	}
	public function setVidThumb($vid_thumb){
		$this->vid_thumb = $vid_thumb;
	}
        
        public function getVidDescricao(){
		return $this->vid_descricao;
	}
	public function setVidDescricao($vid_descricao){
		$this->vid_descricao = $vid_descricao;
	}
        
        public function getVidEmbed(){
		return $this->vid_embed;
	}
	public function setVidEmbed($vid_embed){
		$this->vid_embed = $vid_embed;
	}
        
        public function getCatId(){
		return $this->categoria_id;
	}
	public function setCatId($categoria_id){
		$this->categoria_id = $categoria_id;
	}
        
        public function getCatNome(){
		return $this->cat_nome;
	}
	public function setCatNome($cat_nome){
		$this->cat_nome = $cat_nome;
	}
        
}

?>