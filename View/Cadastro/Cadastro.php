<?php 
    session_start();

    include_once('../../Model/conexao.php');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="./Cadastro.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <header>
        <nav>
            <a href="../Home/Home.php"><span class="mdi mdi-arrow-left"></span></a>
        </nav>
    </header>

    <!--
        Aqui iniciamos nossos testes

        - primeiro testamos se os dados não estão vazios

        - segundo criamos uma variável booleana que vai servir de controle, ou seja, através 
          dela vamos testar se os campos estão vazios ou não quando enviamos.. e inicializamos ela com FALSE..

        - terceiro usamos o array_map (ESTUDEM ISSO, pois não sei explicar oq é..)

        - no primeiro "if", testamos se os campos estão vazios, se estão, a variavel booleana recebe TRUE!
        
        - se não estiverem vazios, chamamos a função para validar o CADASTRO, que está acima..
    -->
    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($dados['enviarForm'])){

            $empty_input= false;
            $dados = array_map('trim', $dados);

            if(in_array("", $dados)){
                $empty_input = true;
                echo" <p style='color: red; text-align: center;font-size: 18px;'>ERRO:Existem campos em branco </p>";
            }
            elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: red; text-align: center; font-size: 18px;'>ERRO : Email incorreto</p>";
            }
            elseif(strlen($dados['senha']) > 8){
                $empty_input = true;
                echo "<p style='color: red; text-align: center;font-size: 18px;'>ALERTA: senha deve conter até 8 caracteres</p>";
            }
            elseif($empty_input == false){
                validarCadastro($dados, $pdo);
            }

        }

            //Valida o Cadastro, testa se existe email cadastrado..
        //Se não existir email.. cadastra o usuario e imprime uma mensagem..
        function validarCadastro($dados, $pdo){
            $queryValidarEmail = "SELECT * FROM projeto.usuarios WHERE email = '".$dados['email']."'";
            $validarEmail = $pdo->prepare($queryValidarEmail);
            $validarEmail->execute();

            if($validarEmail->rowCount() > 0){
               echo "<p style='color: red; text-align: center;font-size: 18px;'>Email em uso!</p>";
            }
            else{

                $queryUsuario = "INSERT INTO projeto.usuarios(email, senha) VALUES('".$dados['email']."', '".$dados['senha']."')";

                $cadastrarUsu = $pdo->prepare($queryUsuario);
                $cadastrarUsu->execute();

                echo "<p style='color: green; text-align: center;font-size: 18px;'>Cadastrado </p>";
                unset($dados);
            }
        }
    ?>


    <div class="centralizaConteudo">
        <main>
            <div class="containerPaiForm">
                <div class="containerBemVindo">
                    <h1>Bem Vindo!</h1>
                    <p id="marginParagrafoLogin">Para continuar conectado conosco</p>
                    <p class="marginSegundoParagrafoLogin">por favor realize seu login com as suas</p> 
                    <p class="marginTerceiroParagrafoLogin">informações pessoais!</p>

                    <div class="divPaiLinkLogin">
                        <div class="divFilhoLinkLogin" id="marginLinkLogin">
                            <a href="../Login/Login.php" class="linkLogin">Login</a>
                        </div>
                    </div>
                </div>

                <div class="containerForm">
                    <form method="post" action="">
                        <div>
                            <h1>Cadastro</h1>
                            <p>Use seu email para cadastrar</p>
                        </div>
                        <div class="divInputPai">
                                    
                            <div class="divInputFilho">
                                <span class="mdi mdi-email"></span>
                                <input type="text" name="email" id="idEmail" placeholder="Email">
                            </div>

                            <div class="divInputFilho">
                                <span class="mdi mdi-lock"></span>
                                <input type="password" name="senha" id="idSenha" placeholder="Senha">
                            </div>
            
                            
                            <div class="divFilhoInputLembrarSenha">
                                <label class="labelLembrarSenha" for="lembrarSenha">Lembrar senha</label>
                                <input type="checkbox" name="lembrarSenha">
                            </div>

                            <div class="divFilhoInputCadastrar">
                                <input type="submit" value="Cadastrar" name="enviarForm">
                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
  <footer class="footer">
    <sup>©</sup>2024 - Todos os direitos Reservados
  </footer>

</body>
</html> 