<?php

/**
 * Autor: Marcio Souza
 * Revisao: 1
 * Data: 9/03/2012
 * Arquivo de baixa das Cartas Fretes Pendentes
 * gerado pelo netbeans
 * 
 * 
 */
    include_once '../model/Class.Galeria.php';
    include_once '../controller/ColGaleria.php';
    include_once '../controller/ColConectar.php';

    @$_SESSION['servidor'] = $servidor; //variavel em propriedades.php 
    @session_start('login');

    # Rcebe a funcao do javascript    
    @$funcao = $_REQUEST['funcao'];

    # Verifica qual funcao sera chamada no php
    @call_user_func($funcao);
    
    function novoVideo(){
    // Consulta a tab_carta o numero da carta e a unidade
        $obj = (object) $_REQUEST['obj'];
        $conCla = new Galeria();
        $conCol = new ColGaleria();
        $url = strip_tags(trim($obj->vid_url));
        //var_dump($url);
        if(substr_count($url, 'youtube') == 1){
                $idVid = substr($url, 31, 11);
                $thumb = 'http://i1.ytimg.com/vi/'.$idVid.'/default.jpg';
                $pega = get_meta_tags("http://www.youtube.com/watch?v=HfF7LFlt7oI");//Aqui pega as tags e armazena nessa variável
                $teste = $pega['title'];
                $conteudo = get_meta_tags('http://www.youtube.com/watch?v='.$idVid);
                $titulo = $conteudo['title'];
                $descricao = $conteudo['description'];
        }elseif(substr_count($url, 'vimeo') == 1){
                $idVid = substr($url, 17);
                $url_img = parse_url($url);
                $conteudo = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($url_img['path'], 1).".php"));
                $thumb = $conteudo[0]['thumbnail_small'];
                $titulo = $conteudo[0]['title'];
                $descricao = $conteudo[0]['description'];
        }
        echo $teste;
        $conCla->setVidCategoria($obj->vid_categoria);
        $conCla->setVidTitulo($obj->vid_titulo);
        $conCla->setVidThumb($thumb);
        $conCla->setVidDescricao($obj->vid_descricao);
        $conCla->setVidEmbed($idVid);
        $conCol->inserir($conCla);
        
    }
    
    function getListaCategoria(){
        $conCol = new ColGaleria();
        $conArray = $conCol->getAllVideoCategoria();

        for ($i=0; $i < count($conArray); $i++){//conta o array e depois escreve ate o final
            $obj[] = array(
                'id'=>$conArray[$i]->categoria_id,
                'nome'=>$conArray[$i]->cat_nome
            );
        }
        echo json_encode($obj);
    }


    function getNewFoto(){
    // Consulta a tab_carta o numero da carta e a unidade
        $obj = (object) $_REQUEST['obj'];
        $conCla = new Galeria();
        $conCol = new ColGaleria();
        
        $conCla->setFotNome($obj->vid_nome);
        $conCla->setFotUrl($obj->vid_url);

        if ($obj->video_id ==''){
            $conCol->inserir($conCla);
            
        }else{
            $conCol->alterar($conCla);
            
        }
    }
?>
