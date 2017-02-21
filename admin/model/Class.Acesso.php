<?php
/**
 * @author Maison K. Sakamoto
 * @version 0
 * Data: 20/12/2011
 * Classe Acesso
 */

class Acesso{
	
	private $for_id;
	private $usu_id;
	
	public function setForId($for_id){
		$this->for_id = $for_id;
	}
	public function getForId(){
		return $this->for_id;
	}
	
	public function setUsuId($usu_id){
		$this->usu_id = $usu_id;
	}
	public function getUsuId(){
		return $this->usu_id;
	}
	
}

?>