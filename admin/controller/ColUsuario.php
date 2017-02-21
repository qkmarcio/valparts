<?php
/**
 * @author Maison K. Sakamoto
 * @version 1 
 * Data: 20/12/2011
 * Controladora do Usuario
 */

class ColUsuario{
	
    public function __construct(){

    }

    public function getLogar($usuario,$senha){
        $query ="SELECT * 
                    FROM tab_usuario 
                    WHERE usu_nome='$usuario' and usu_senha='$senha' ";
        $result = mysql_query($query);
        return $result;

    }
	
}
	

?>