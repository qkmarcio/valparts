<?php

/**
 * @author Maison K. Sakamoto <maison.sakamoto@gmail.com>
 * 
 * Formatador: Usado para formatacao de numeros, datas, etc.
 */
class Formatador{

    /**
     * ex: getMesExtenso(1) retorna Janeiro
     * @param int
     * @return String mes
     */
    public static function getMesExtenso($mes){
        if($mes == 1){return 'JANEIRO';}
        else if($mes == 2){return 'FEVEREIRO';}
        else if($mes == 3){ return 'MARÇO';}
        else if($mes == 4){ return 'ABRIL';}
        else if($mes == 5){ return 'MAIO';}
        else if($mes == 6){ return 'JUNHO';}
        else if($mes == 7){ return 'JULHO';}
        else if($mes == 8){ return 'AGOSTO';}
        else if($mes == 9){ return 'SETEMBRO';}
        else if($mes == 10){ return 'OUTUBRO';}
        else if($mes == 11){ return 'NOVEMBRO';}
        else if($mes == 12){ return 'DEZEMBRO';}
    }
    
    /**
     * Passe o valor tipo float
     * Receba o valor no padrao moeda brasileiro #.###,##
     * @param float
     * @return #.###,##
     */
    public static function convertFloatToMoeda($numero){
        //numero é o valor a ser trabalhado
        //2 é a quantida de casas decimais
        //, é o separador decimal
        //. é o separador de milhar
        return number_format($numero, 2, ',', '.');
    }
    
    /**
     * Passe o valor no padrao moeda brasileiro #.###,##
     * Receba o valor float
     * @param moeda
     * @return ####.##
     */
    public static function convertMoedaToFloat($numero){    
        
        $valor="";
        //verifica se existe virgula na string
        if(strpos($numero, ',')){            
            $source = array('.', ',');  
            $replace = array('', '.'); 
            $valor = str_replace($source, $replace, $numero); //remove os pontos e substitui a virgula pelo ponto 
        }
        return $valor; //retorna o valor formatado para gravar no banco        
    }
    
    /**
     * Passe uma string para preencher um field de tamanho fixo     * 
     * @param $string
     * @param $limiteLinha
     * @return string para concatenar com a sua string
     */
    public static function preencherFinalDaLinha($string,$limiteLinha) {
        $finalLinha="";
        $index = ($limiteLinha-strlen($string));
        while($index > 0) {
            $finalLinha =$finalLinha." *";
            $index = ($index-2);
        }
        return $finalLinha;
    }
    
    /**
     * Passe um numero ex: 1, e passe quantos digitos desejar
     * digitos=2, saida == 01
     * @param numero pode ser string
     * @param int digitos
     * @return novo numero
     */
    public static function zeroEsquerda($numero,$digitos){        
        $tam = strlen($numero);
        for ($index = $tam; $index < $digitos; $index++) {
            $numero = '0'.$numero;
        }
        return $numero;
    }
    
    /**
     * Passe um cpf sem mascara ex: 04107520960, saida == 041.075.209-60
     * @param numero pode ser string     
     * @return string com mascara
     */
    public static function criarMascaraCpf($numero){
        $comeco = substr($numero, 0,-8).".";
        $comeco = $comeco . substr($numero, 3,-5).".";
        $comeco = $comeco . substr($numero, 6,-2)."-".  substr($numero, -2);
        return $comeco;
    }
    
    public static function criarMascaraCnpj($numero){
        return substr($numero, 0,-12).".".substr($numero, 2,-9).".".substr($numero, 5,-6)."/".substr($numero, 8,-2)."-".substr($numero, 12);
    }
    
    /**
     * Passe um campo com mascara ex: 2011-01-01, saida == 01/01/2011
     * @param string
     * @return string
     */
    public static function dateEmPortugues($dateSql){
        $ano= substr($dateSql, 0,-6);
        $mes= substr($dateSql, 5,-3);
        $dia= substr($dateSql, 8);
        return $dia."/".$mes."/".$ano;
    }
    
    /**
     * Passe um campo com mascara ex: 01/01/2011, saida == 2011-01-01
     * @param string
     * @return string
     */
    public static function dateEmMysql($dateSql){
        $ano= substr($dateSql, 6);
        $mes= substr($dateSql, 3,-5);
        $dia= substr($dateSql, 0,-8);
        return $ano."-".$mes."-".$dia;
    }

    /**
     * Passe um campo com mascara ex: 031.716.658-16, saida == 03171665816
     * @param string     
     * @return novo string(numero)
     */
    public static function somenteNumeros($variavel){
            $variavel = str_replace(".", "", $variavel);
            $variavel = str_replace("-", "", $variavel);
            $variavel = str_replace("/", "", $variavel);
            return $variavel;
        }

}
?>
