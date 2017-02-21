<?php
/**
 * @author Marcio O. Souza
 * Data: 09/01/01
 * @version 0
 * @todo Consulta Ref os Musicos para o  site e are administrativa
 */
    include_once '../controller/ColConectar.php';
    include_once '../controller/ColComponente.php';
    include_once '../lib/Formatador.php';
    include_once '../model/Class.Componente.php';
    include_once "../propriedades.php"; 

    @$_SESSION['servidor'] = $servidor; //variavel em propriedades.php 
    @session_start('login');

    # Recebe os campos dos formulário via POST

    # Rcebe a funcao do javascript    
    $funcao = $_REQUEST['funcao'];

    # Verifica qual funcao sera chamada no php
    call_user_func($funcao);
        
    # Verifica o Instrumendo do Musico Para O Site
    function getMusico(){
        $colCom = new ColComponente();
        $componenteArry = $colCom->getMusicoSite();

        $instrumento = filtrarFuncao($componenteArry,'1 VIOLINO');
            inseriTable($instrumento,'1 VIOLINO');

        $instrumento = filtrarFuncao($componenteArry,'2 VIOLINO');
            inseriTable($instrumento,'2 VIOLINO');

        $instrumento = filtrarFuncao($componenteArry,'VIOLA');
            inseriTable($instrumento,'VIOLA');

        $instrumento = filtrarFuncao($componenteArry,'CELLO');
            inseriTable($instrumento,' CELLO');

        $instrumento = filtrarFuncao($componenteArry,'FLAUTA');
            inseriTable($instrumento,' FLAUTA');

        $instrumento = filtrarFuncao($componenteArry,'CLARINETA');
            inseriTable($instrumento,' CLARINETA');

        $instrumento = filtrarFuncao($componenteArry,'SAX ALTO');
            inseriTable($instrumento,'SAX ALTO');

        $instrumento = filtrarFuncao($componenteArry,'SAX TENOR');
            inseriTable($instrumento,' SAX TENOR');

        $instrumento = filtrarFuncao($componenteArry,'SAX SOPRANO');
            inseriTable($instrumento,' SAX SOPRANO');

        $instrumento = filtrarFuncao($componenteArry,'TROMPETE');
            inseriTable($instrumento,' TROMPETE');

        $instrumento = filtrarFuncao($componenteArry,'TROMPA');
            inseriTable($instrumento,' TROMPA');

        $instrumento = filtrarFuncao($componenteArry,'TROMBONE');
            inseriTable($instrumento,' TROMBONE');

        $instrumento = filtrarFuncao($componenteArry,'TECLADO');
            inseriTable($instrumento,' TECLADO');

        $instrumento = filtrarFuncao($componenteArry,'BAIXO');
            inseriTable($instrumento,' BAIXO');

        $instrumento = filtrarFuncao($componenteArry,'PERCUSSAO');
            inseriTable($instrumento,' PERCUSSÃO');

    }

    function inseriTable($array,$nome){
        $i = 0;
        echo " <br/><h2>" . $nome . "</h2>";
        echo "<p ><table>";
            while( $i < count($array)){
                echo "<tr>
                        <td class='cmusico'><a href=images/componentes/".$array[$i]->getComfoto()." rel='prettyPhoto' title='".$array[$i]->getComNome()."' >".$array[$i]->getComNome(). "</a></td>";
                        if( ($i+1) < count($array) ){
                                echo "<td class='cmusico'><a href=images/componentes/".$array[$i+1]->getComfoto()." rel='prettyPhoto' title='".$array[$i+1]->getComNome()."' >".$array[$i+1]->getComNome(). "</a></td>";
                        }
                echo "</tr>";

                $i = $i+2;
            }
        echo "</table></p><br/>";
    }

    function filtrarFuncao($array,$funcao){
        $arrayFiltrado;
        for($index =0; $index < count($array); $index++){
            if(strcmp($array[$index]->getComInstrumento(),$funcao) == 0){
                $arrayFiltrado[] = $array[$index];
            }
        }
        return $arrayFiltrado;
    }

    function getLista(){
        $conColl = new Colcomponente();
        $conArray = $conColl->getlistacomponente();

        for ($i=0; $i < count($conArray); $i++){//conta o array e depois escreve ate o final
            $obj[] = array(
                'statos'=>$conArray[$i]->comstatos,
                'id'=>$conArray[$i]->idcomponente,
                'Nome'=>$conArray[$i]->comnome,
                'Nascimento'=>Formatador::dateEmPortugues($conArray[$i]->comnascimento),
                'Telefone'=>$conArray[$i]->comtelefone,
                'Celular'=>$conArray[$i]->comcelular,
                'Instrumento'=>$conArray[$i]->cominstrumento,
            );
        }
        echo json_encode($obj);
    }
	
    function getEditar(){
        $obj = (object) $_REQUEST['obj'];
        $conColl = new Colcomponente();
        $conArray = $conColl->getById($obj->id);

        //conta o array e depois escreve ate o final
        $obj=
            array(
                'id'=>$conArray->idcomponente,
                'Nome'=>$conArray->comnome,
                'Nascimento'=>Formatador::dateEmPortugues($conArray->comnascimento),
                'Telefone'=>$conArray->comtelefone,
                'Celular'=>$conArray->comcelular,
                'Endereco'=>$conArray->comendereco,
                'Bairro'=>$conArray->combairro,
                'Email'=>$conArray->comemail,
                'Cep'=>$conArray->comcep,
                'Statos'=>$conArray->comstatos,
                'Instrumento'=>$conArray->cominstrumento,
                'Observacao'=>$conArray->comobservacao,
            );

        echo json_encode($obj);
    }
?>
