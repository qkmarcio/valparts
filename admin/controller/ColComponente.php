<?php
/**
 * Nesta Class esta TODOS os SELECT's, UPDATES e INSERT's da tab_proprietario
 * Aqui trabalha com TODOS os get's e set's que vem da Class.Proprietario.php
 * Autor: Marcio Souza
 * Revisao: 0
 * Data: 09/12/2011
 * 
 * * @version 3
 * @author Marcio Souza
 * data: 12/01/2012
 * novo atributo prop_rtb,prop_inss
 */
 
Class Colcomponente{
	
    public function __construct(){

    }
	
    public function getAll(){

        $query ="SELECT *
                FROM componente
                ORDER BY comnome";
        $result = mysql_query($query);

            while ($obj = mysql_fetch_object($result)) {
                $con = new Componente();
                $con->setIdComponente($obj->idcomponente);
                $con->setComNome($obj->comnome);
                $con->setComNascimento ($obj->comnascimento);
                $con->setComTelefone($obj->comtelefone);
                $con->setComCelular($obj->comcelular);
                $con->setComEndereco($obj->comendereco);
                $con->setComBairro($obj->combairro);
                $con->setComEmail($obj->comemail);
                $con->setComCep($obj->comcep);
                $con->setComInstrumento($obj->cominstrumento);
                $con->setComObservacao($obj->comobservacao);
		$con->setComFoto($obj->comfoto);
                
                $conArry[] = $con;
            }
        return $conArry;
    }
	
//Ele retorna todos os objetos da tab_proprietario 
//Passar parametro tipo INTEIRO
    public function getById($id){
        $query ="SELECT *
                FROM componente
                WHERE idcomponente= $id
                ORDER BY comnome";
            $result = mysql_query($query);
            $obj = mysql_fetch_object($result);

            return $obj;
    }
	
//Para utilizar o objeto deve estar TODO preenchido	
    public function inserir($obj) {
        $query = "INSERT INTO componente
                (comnome, comnascimento, comtelefone, comcelular, comendereco, combairro, 
                comemail, comcep, cominstrumento, comfoto, comstatos, comobservacao) 
            VALUES
                ('".ucwords($obj->getComNome() )."', 
                STR_TO_DATE('".$obj->getComNascimento()."','%d/%m/%Y'), 
                '".$obj->getComTelefone()."',
                '".$obj->getComCelular()."',
                '".ucwords($obj->getComEndereco() )."',
                '".$obj->getComEmail()."', 
                '".ucwords($obj->getComBairro() )."',
                '".$obj->getComCep()."',
                '".ucwords($obj->getComInstrumento())."',
                '".ucwords($obj->getComFoto())."',
                '".$obj->getComStatos()."',
                '".$obj->getComObservacao()."')
            ";
      	mysql_query($query) or die("<br>erro no UPDATE <br> " + $query);	
              
    }
	
    public function alterar($obj) { 
        $query = "UPDATE componente set 
            comnome='".             ucwords($obj->getComNome() )."',
            comnascimento=".       "STR_TO_DATE('".$obj->getComNascimento()."','%d/%m/%Y'),
            comtelefone='".         $obj->getComTelefone()."',
            comcelular='".          $obj->getComCelular()."',
            comendereco='".         ucwords($obj->getComEndereco() )."',
            combairro='".           ucwords($obj->getComBairro() )."',
            comemail='".            $obj->getComEmail()."',
            comcep='".              $obj->getComCep()."',
            cominstrumento='".      ucwords($obj->getComInstrumento())."',
            comfoto='".             ucwords($obj->getComFoto())."',
            comstatos='".           $obj->getComStatos()."',    
            comobservacao='".       $obj->getComObservacao()."'
            WHERE idcomponente=".$obj->getIdComponente()."
            "; 

            mysql_query($query) or die("<br>erro no UPDATE <br> " + $query);	

    }
    
	
    public function getBusca($obj){

        $query = "SELECT * FROM componente where comnome like '%".$obj."%' order by comnome";
        $result = mysql_query($query);

            while ($obj = mysql_fetch_object($result)) {
                $con = new Componente();
                $con->setIdComponente($obj->idcomponente);
                $con->setComNome($obj->comnome);
                $con->setComNascimento($obj->conascimento);
                $con->setComTelefone($obj->comtelefone);
                $con->setComCelular($obj->comcelular);
                $con->setComEndereco($obj->comendereco);
                $con->setComBairro($obj->combairro);
                $con->setComEmail($obj->comemail);
                $con->setComCep($obj->comcep);
                $con->setComInstrumento($obj->cominstrumento);
                $con->setComObservacao($obj->comobservacao);
                
                $conArry[] = $con;

            }
        return @$conArry;
    }
    
    public function getMusicoSite(){

        $query ="SELECT * FROM listaSite";
        
        $result = mysql_query($query);

            while ($obj = mysql_fetch_object($result)) {
                $con = new Componente();
                
                $con->setComNome($obj->comnome);
                $con->setComInstrumento($obj->cominstrumento);
		$con->setComFoto($obj->comfoto);
                //$con->setComStatos($obj->comstatos);
                
                $conArry[] = $con;
            }
        return $conArry;
    }
    
    function getlistacomponente(){
        $query ="SELECT * FROM getlistacomponente order by comstatos";
        
        $result = mysql_query($query);

            while ($obj = mysql_fetch_object($result)) {
                
                $conArry[] = $obj;
            }
        return $conArry;
    }
	
}

?>