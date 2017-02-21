<?php
require "./controller/ColConexao.php";

/*$nome = 'Marcio Oliveira de Souza';
$login = 'marcio';
$email = 'marcio@valpartssa.com';
$senha = password_hash('123', PASSWORD_DEFAULT);


$conexao = cConexao::getInstance();
$sql = "INSERT INTO tab_usuario(usu_nome, usu_login,usu_email, usu_senha, usu_status)VALUES('{$nome}', '{$login}', '{$email}', '{$senha}', '0')";
$stm = $conexao->prepare($sql);
$stm->execute();*/
    $pdo = Database::conexao();
    //$stmt = $pdo->prepare('SELECT * FROM usuarios');
try{
    //executa a instrução de consulta
    //$cConexao->beginTransaction();
 
    $stmt = $pdo->prepare("INSERT INTO tab_usuario(usu_nome, usu_login,usu_email, usu_senha, usu_status)VALUES(?,?,?,?,?)");
    $stmt->bindValue(1, "Marcio Oliveira de Souza");
    $stmt->bindValue(2, "marcio");
    $stmt->bindValue(3, "marcio@valpartssa.com");
    $stmt->bindValue(4, "123");
    $stmt->bindValue(5, "0");
    $stmt->execute();
 
    $pdo->commit();
 
}catch (PDOException $e){
    $pdo->rollBack();
    echo $e->getMessage();
}