<?php
/*
 * Autor: Maison K. Sakamoto
 * Revisao: 0
 * Data: 23/02/2012
 *
 * Descricao: 
 * Controle de Acesso
 */
class ColAcesso{

    public function __construct(){

    }
            
    public function menuUsuario($usu_id){
        $query = "SELECT
                    m.mod_nome
                    FROM 
                    tab_usuario u,
                    rel_acessos a,
                    tab_modulo m,
                    tab_formulario f
                    WHERE
                    u.usu_id = $usu_id and 
                    u.usu_id = a.usu_id and
                    a.for_id = f.for_id and
                    f.mod_id = m.mod_id
                    ORDER BY m.mod_nome";

        $result = mysql_query($query) or die("$query<br>".mysql_error());                

        while ($obj = mysql_fetch_array($result)) {
            $retorno[] = $obj;
        }
        return $retorno;
    }
    public function getModulo($usu_id){
        $query = "SELECT
                    m.mod_id,
                    m.mod_nome
                    FROM 
                    tab_usuario u,
                    rel_usu_for a,
                    tab_modulo m,
                    tab_formulario f
                    WHERE
                    u.usu_id = $usu_id and 
                    u.usu_id = a.usu_id and
                    a.for_id = f.for_id and
                    f.mod_id = m.mod_id
                    ORDER BY m.mod_nome";

        $result = mysql_query($query) or die("$query<br>".mysql_error());                

        while ($obj = mysql_fetch_array($result)) {
            $retorno[] = $obj;
        }
        return $retorno;
    }
    
    public function fomularioUsuario($usu_id){
        $query = "SELECT
                    m.mod_id mMod_id,
                    m.mod_nome,
                    f.mod_id fMod_id,
                    f.for_nome,
                    f.for_url
                    FROM 
                    tab_usuario u,
                    rel_usu_for a,
                    tab_modulo m,
                    tab_formulario f
                    WHERE
                    u.usu_id = $usu_id and 
                    u.usu_id = a.usu_id and
                    a.for_id = f.for_id and
                    f.mod_id = m.mod_id
                    ORDER BY m.mod_nome";

        $result = mysql_query($query) or die("$query<br>".mysql_error());                

        while ($obj = mysql_fetch_array($result)) {
            $retorno[] = $obj;
        }
        return $retorno;
    }
}
?>