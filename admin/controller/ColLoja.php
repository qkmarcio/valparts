<?php
/**
 * @author Marcio Souza
 * @version 0 
 * Data: 04/09/2012
 * Controladora da Loja
 */

class ColLoja{
	
    public function __construct(){

    }

    public function getAllLoja(){
        $query ="SELECT * 
                    FROM tab_loja 
                    ";
        $result = mysql_query($query);
        
        while ($obj = mysql_fetch_object($result)) {
            $con = new Loja();
            $con->setLojaId($obj->loja_id);
            $con->setLojCategoria($obj->loj_categoria);
            $con->setLojNome($obj->loj_nome);
            $con->setLojPreco($obj->loj_preco);
            $con->setLojDesconto($obj->loj_desconto);
            $con->setLojDescricao($obj->loj_descricao);
            $con->setLojPrincipal($obj->loj_principal);
            $con->setLojFoto($obj->loj_foto);
            $conArry[] = $con;
        }
        return $conArry;

    }
    public function inserir($obj) {
        
        $query = "INSERT INTO tab_loja
                (loj_categoria,loj_nome, loj_preco, loj_desconto, loj_descricao, loj_principal, loj_foto) 
            VALUES
                (".$obj->getLojCategoria() .",
                '".$obj->getLojNome() ."',
                ".$obj->getLojPreco().",
                ".$obj->getLojDesconto().",
                '".$obj->getLojDescricao()."',
                '".$obj->getLojPrincipal()."',
                '".$obj->getLojFoto()."')
            ";
        //var_dump($query);
      	mysql_query($query) or die("<br>erro no UPDATE <br> " + $query);	
              
    }
	
    public function alterar($obj) { 
        $query = "UPDATE tab_videos set 
            loj_categoria='".    $obj->getLojCategoria() .",
            loj_nome='".    $obj->getLojNome() ."',
            loj_preco=".    $obj->getLojPreco()."',
            loj_desconto=". $obj->getLojDesconto()."',
            loj_descricao=".$obj->getLojDescricao()."',
            loj_principal=".$obj->getLojPrincipal()."',
            loj_foto=       ".$obj->getLojFoto()."',
            WHERE loja_id=".$obj->setLojaId()."
            "; 

            mysql_query($query) or die("<br>erro no UPDATE <br> " + $query);	

    }
    
    public function getAllLojaCategoria(){
        $query ="SELECT * FROM tab_loja_categoria";
        $result = mysql_query($query);
        while ($obj = mysql_fetch_object($result)) {
            $conArry[] = $obj;
        }
        return $conArry;

    }

	
}
	

?>