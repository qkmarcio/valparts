<?php
/*
 * Autor: Marcio Souza
 * Data: 14/12/2011
 * Revisao: 0
 * Descricao: Cadastro dos Mosicos da Orquestra
 */

include_once ("../controller/ColLoja.php");
include_once ("../model/Class.Loja.php");
include_once ("../controller/OpenDB.php");
include_once ("../lib/Formatador.php");

@session_start('login'); 

    //Conexao com o banco
    $c = new OpenDB();
    $c->conectarNovamente($_SESSION['usuario'],$_SESSION['senha']);//NOVA CONEXAO COM BANCO

    // Recupera os dados dos campos
	$id          =  $_POST['id'];
        $categoria   =  $_POST['categoria'];
        $nome        =  $_POST['nome'];
        $preco       =  $_POST['preco'];
        $desconto    =  $_POST['desconto'];
        $principal   =  $_POST['radio'];
        $descricao   =  $_POST['descricao'];
	$foto        =  $_FILES["foto"];
        
        //Se a foto estiver sido selecionada
        if (!empty($foto["name"])) {
            //Pegando as informações da imagem
            $TamanhoImagem = getimagesize($_FILES["foto"]['tmp_name']);
            $extensao = substr($foto['name'],-3);
            //Criando um array com as estensões permitidas
            $ExtPermitidas = array("gif","jpg","png");
                if($TamanhoImagem[0] < 301 && $TamanhoImagem[1] < 301){
                    if(in_array($extensao,$ExtPermitidas)){
                        // Gera um nome único para a imagem
                        $nome_imagem = md5(uniqid(time())) . "." . $extensao;
                        // Caminho de onde ficará a imagem
                        $caminho_imagem = "../../imagen/loja/";
                        $targetPath =  $caminho_imagem . $nome_imagem;
                        // Faz o upload da imagem para seu respectivo caminho
                        move_uploaded_file($foto["tmp_name"], $targetPath);

                    }  else {
                        echo "<script language='JavaScript'>
                            alert('Extesão $extensao não é valida .');
                        </script>";
                    }
                }  else {
                    echo "<script language='JavaScript'>
                            alert('Altura $TamanhoImagem[1]px max 300px e largura $TamanhoImagem[0]px 300px max.');
                        </script>";
                }
        
        }
        //Chama a Class
        $com = new Loja();
        //Chama a Controller
        $colCom = new ColLoja();
	
        $com->setLojaId($id);
        $com->setLojNome($nome);
        $com->setLojCategoria($categoria);
	$com->setLojPreco(Formatador::convertMoedaToFloat($preco));
	$com->setLojDesconto(Formatador::convertMoedaToFloat($desconto));
        $com->setLojDescricao($descricao);
	$com->setLojPrincipal($principal);
	$com->setLojFoto(@$nome_imagem);
	
        
        if ($id ==''){
           // var_dump($com);
            $colCom->inserir($com);
            //var_dump($colCom);
            echo "<script language='JavaScript'>
                    alert('Cadastro Concluido com sucesso.');                    
                    window.location = '../html/principal.php';
                 </script>";
        }else{
            $colCom->alterar($com);
            finalizado();

        }
    //Mensagem apos finalizar o cadastro
	function finalizado(){
		@$_SESSION["sub_menu"]='ListComponente.php'; //CHAMADA PARA RETORNAR AO MESMO CADASTRO
		echo "<script language='JavaScript'> 	
				alert('Cadastro Alterado com sucesso.');
				window.location = '../html/principal.php';
	  	  	</script>";		
	}
?>