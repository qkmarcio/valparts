<?php

/**
 * @author Marcio Souza
 * 
 * Formatador: Usado para formatacao de numeros, datas, etc.
 */
class Formatador{
    
    /**
     * Passe um campo com mascara ex: 2011-01-01, saida == 01/01/2011
     * @param string
     * @return string
     */
    public static function dataMysqlBr($param) {
        $param = implode("/", array_reverse(explode("-",$param)));
        return $param;
    }
    
    /**
     * Passe um campo com mascara ex: 01/01/2011 , saida == 2011-01-01 
     * @param string
     * @return string
     */
    public static function dataBrMysql($param) {
        $param = implode("-", array_reverse(explode("/",$param)));
        return $param;
    }
}