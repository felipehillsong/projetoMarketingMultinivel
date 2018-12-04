<?php
require 'config.php';
session_start();

if(!empty($_POST['nome']) && !empty($_POST['email'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $id_pai = $_SESSION['smmlogin'];
    $senha = md5($email);

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $sql->bindValue(":email", $email);
    $sql->execute();

    if($sql->rowCount == 0){
        $sql = $pdo->prepare("INSERT INTO usuarios(id_pai, nome, email, senha) VALUES(:id_pai, :nome, :email, :senha)");
        $sql->bindValue(":id_pai", $id_pai);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        header("Location: index.php");
    }else{
        echo "Usuario Cadastrado!";
    }
    
}
?>
<h1>Cadastrar Novo Usuário</h1>
<form method="POST">
Nome<br/>
<input type="text" name="nome" /><br/><br/>

E-mail<br/>
<input type="email" name="email" /><br/><br/>

<input type="submit" value="Cadastrar">

</form>