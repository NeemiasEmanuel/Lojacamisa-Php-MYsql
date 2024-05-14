<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=five_sports','root', 'senha');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $erro){
        echo "ERRO => " . $erro->getMessage();
    }
?>