<?php
require 'config.php';
require 'funcoes.php';
session_start();

$sql = "SELECT id FROM usuarios";
$sql = $pdo->query($sql);
$usuarios = array();

if($sql->rowCount() > 0){
    $usuarios = $sql->fetchAll();
    foreach($usuarios as $chave => $usuario){
        $usuarios[$chave]['filhos'] = calcular_cadastros($usuario['id'], $limite);        
    }
}
$sql = "SELECT * FROM patentes ORDER BY minimo DESC";
$sql = $pdo->query($sql);
$patentes = array();
if($sql->rowCount() > 0){
    $patentes = $sql->fetchAll();
}

foreach($usuarios as $usuario){
    foreach($patentes as $patente){
        if(intval($usuario['filhos']) >= intval($patente['minimo'])){
            $sql = "UPDATE usuarios SET patente = :patente WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":patente", $patente['id']);
            $sql->bindValue(":id", $usuario['id']);
            $sql->execute();
            break;
        }
    }
}
?>