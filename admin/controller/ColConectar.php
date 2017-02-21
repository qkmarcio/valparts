<?php
/* Este arquivo conecta um banco de dados MySQL
 * Na function conectar() apontar para qual servido você deseja se conectar
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 09/12/2011
 */

	include_once 'OpenDB.php';
    	
	conectar();
        //remoto();
    	//Verifica a conexao do usuario e conecta no banco
    	function conectar(){
       	 //Conexao com o Banco
        	$open = new OpenDB();
        	$open->setUsuario('root');
        	$open->setSenha('');
        	$open->conectar();
    	}
        function remoto(){
       	 //Conexao com o Banco
        	$open = new OpenDB();
        	$open->setUsuario('orquestr_site');
        	$open->setSenha('Minotauro@036');
        	$open->conectar();
    	}

?>