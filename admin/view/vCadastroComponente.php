<?php
/*
 * Autor: Marcio Souza
 * Data: 14/12/2011
 * Revisao: 0
 * Descricao: Cadastro dos Mosicos da Orquestra
 */

include_once ("../controller/ColComponente.php");
include_once ("../model/Class.Componente.php");
include_once ("../controller/OpenDB.php");

@session_start('login'); 

    //Conexao com o banco
    $c = new OpenDB();
    $c->conectarNovamente($_SESSION['usuario'],$_SESSION['senha']);//NOVA CONEXAO COM BANCO

    // Recupera os dados dos campos
	$id          =  $_POST['id'];
        $nome        =  $_POST['nome'];
        $data        =  $_POST['data'];
        $telefone    =  $_POST['telefone'];
        $celular     =  $_POST['celular'];
        $endereco    =  $_POST['endereco'];
        $bairro      =  $_POST['bairro'];
        $cep         =  $_POST['cep'];
	$email       =  $_POST['email'];
        $instrumento =  $_POST['instrumento'];
        $statos      =  $_POST['radio'];
        $descricao   =  $_POST['descricao'];
	$foto        =  $_FILES["foto"];
        
        
    // Se a foto estiver sido selecionada
    if (!empty($foto["name"])) {
    
        // Pega extensão da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

        // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        // Caminho de onde ficará a imagem
        $caminho_imagem = "../../images/componentes/";
        $targetPath =  $caminho_imagem . $nome_imagem;

	// Faz o upload da imagem para seu respectivo caminho
	move_uploaded_file($foto["tmp_name"], $targetPath);
    }
        //Chama a Class
        $com = new Componente();
        //Chama a Controller
        $colCom = new ColComponente();
			
        $com->setIdComponente($id);
	$com->setComNome($nome);
	$com->setComNascimento($data);
	$com->setComTelefone($telefone);
        $com->setComCelular($celular);
	$com->setComEndereco($endereco);
	$com->setComBairro($bairro);
	$com->setComCep($cep);
	$com->setComEmail($email);
	$com->setComInstrumento($instrumento);
        $com->setComStatos($statos);
	$com->setComObservacao($descricao);
        $com->setComFoto(@$nome_imagem);
        
        if ($id ==''){
            $colCom->inserir($com);
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