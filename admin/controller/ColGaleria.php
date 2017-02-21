<?php
/**
 * @author Maison K. Sakamoto
 * @version 1 
 * Data: 20/12/2011
 * Controladora do Usuario
 */

class ColGaleria{
	
    public function __construct(){

    }

    public function getAllVideo(){
        $query ="SELECT * 
                    FROM tab_videos 
                    ";
        $result = mysql_query($query);
        
        while ($obj = mysql_fetch_object($result)) {
            $con = new Galeria();
            $con->setVideoId($obj->video_id);
            $con->setVidCategoria($obj->vid_categoria);
            $con->setVidTitulo($obj->vid_titulo);
            $con->setVidThumb($obj->vid_thumb);
            $con->setVidDescricao($obj->vid_descricao);
            $con->setVidEmbed($obj->vid_embed);
            $conArry[] = $con;
        }
        return $conArry;

    }
    public function inserir($obj) {
        $query = "INSERT INTO tab_videos
                (vid_categoria, vid_titulo, vid_thumb, vid_descricao, vid_embed) 
            VALUES
                (".$obj->getVidCategoria() .",
                '".$obj->getVidTitulo()."',
                '".$obj->getVidThumb()."',
                '".$obj->getVidDescricao()."',
                '".$obj->getVidEmbed()."')
            ";
      	mysql_query($query) or die("<br>erro no UPDATE <br> " + $query);	
              
    }
	
    public function alterar($obj) { 
        $query = "UPDATE tab_videos set 
            vid_categoria='".  $obj->getVidCategoria() ."',
            vid_titulo=".      $obj->getVidTitulo()."'
            vid_thumb=".       $obj->getVidThumb()."'
            vid_descricao=".   $obj->getVidDescricao()."'
            vid_Embed=".       $obj->getVidEmbed()."'
            WHERE video_id=".$obj->getVideoId()."
            "; 

            mysql_query($query) or die("<br>erro no UPDATE <br> " + $query);	

    }
    
    public function getAllVideoCategoria(){
        $query ="SELECT * FROM tab_video_categoria";
        $result = mysql_query($query);
        while ($obj = mysql_fetch_object($result)) {
            $conArry[] = $obj;
        }
        
        return $conArry;

    }
	
}
	

?>