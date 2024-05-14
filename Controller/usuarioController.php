<?php
    include '../Model/conexao.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    function validarDados($dados, $pdo){
        $queryValidarEmail = "SELECT * FROM five_sports.usuario WHERE email = '".$dados['email']."'";
        $queryValidarLogin = "SELECT * FROM five_sports.usuario WHERE email = '".$dados['email']."'" . 
        "AND senha = '".$dados['senha']."'";

        $validarLogin = $pdo->prepare($queryValidarLogin);
        $validarEmail = $pdo->prepare($queryValidarEmail);

        if($validarLogin->execute() && $validarEmail->execute()){
           if($validarLogin->rowCount() > 0){
                return "redirect:/Home";
           }
           else if($validarEmail->rowCount() == 0){
                return true;
           }
           else{
                return false;
           }
        }

    }

    function cadastrar($dados, $pdo){
 
        $queryUsuario = "INSERT INTO five_sports.usuario(email, senha)
        VALUES('".$dados['email']."', '".$dados['senha']."')";
        
        $resultValidacao = validarDados($dados, $pdo);

        $cadastrarUsu = $pdo->prepare($queryUsuario);

        if($resultValidacao == true){
            $cadastrarUsu->execute();
            echo "Usuario cadastrado com sucesso";
        }
        else{
            echo "Usuario já cadastrado";
        }
    
    }

    if(!empty($dados['enviarForm'])){
        cadastrar($dados, $pdo);
    }
    else{
        echo "erro";
    }
        
?>