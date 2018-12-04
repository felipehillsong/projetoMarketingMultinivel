<?php
try{
    global $pdo;
    $pdo = new PDO("mysql:dbname=projeto_smm;host=localhost", "root", "");

}catch(PODException $e){
    echo "Erro ".$e->getMessage();
}
$limite = 3;

$patente = array();

?>