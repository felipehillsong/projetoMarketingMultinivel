<?php
require 'config.php';
session_start();

if(!empty($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);
    $sql->execute();

    if($sql->rowCount() > 0){
        $sql = $sql->fetch();
        $_SESSION['smmlogin'] = $sql['id'];
        header("Location: index.php");

    }else{
        echo "Usuário e/ou senha errados!";
    }
}

?>
<form method="POST">
    Email<br/>
    <input type="email" name="email" /><br/><br/>

    Senha<br/>
    <input type="password" name="senha" /><br/><br/>

    <input type="submit" value="Entrar">
</form>