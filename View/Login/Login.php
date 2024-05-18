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
    <link rel="stylesheet" href="./Login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <header>
        <nav>
            <a href="../Cadastro/Cadastro.php"><span class="mdi mdi-arrow-left"></span></a>
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
                echo" <p style='color: red; text-align: center;'>ERRO:Existem campos em branco </p>";
            }
            else if($empty_input == false){
                validarLogin($dados, $pdo);
            }

        }

    //Valida o Login

        //Aqui fizemos um teste para ver se o email informado e a senha existem em conjunto, pois para logar, é preciso que exista um email e uma senha validos!!

        //Se existir, vamos redirecionar o usuario para a Home, e de alguma forma informar q o login foi um sucesso!

        //o unset apaga os dados da variável $dados, e deixa os dados somente no MySQL..

        /*Como já sabemos de antemão que o email existe por conta da função VALIDAR CADASTRO, que testa somente se o email existe!!
        se por acaso o teste do VALIDAR LOGIN falhar, significa que a senha do usuario está incorreta, pois sabemos que o email existe!
        Por isso imprimimos uma mensagem de "Senha inválida
        */

        function validarLogin($dados, $pdo){
            $queryValidarLogin = "SELECT * FROM projeto.usuarios WHERE email = '".$dados['email']."'" . 
            "AND senha = '".$dados['senha']."'";

            $validarLogin = $pdo->prepare($queryValidarLogin);
            $validarLogin->execute();

            if($validarLogin->rowCount() > 0){
                unset($dados);
                $usuario = $validarLogin->fetch(PDO::FETCH_ASSOC);//Com o FECTH_ASSOC, consigo recuperar as colunas e os valores delas no MySQL, conseguindo assim acessar o id, o email e a senha
                $usuario_id = $usuario['idusuarios']; // Capturar o ID do usuário
                $_SESSION['idusuarios'] = $usuario_id; // Armazenar o ID do usuário em uma variável de sessão

                header("Location: ../Home/Home.php");
                exit;
            }
            else{
                echo" <p style='color: red; text-align: center;'>ERRO: Email ou Senha Incorretos</p>";
            }
        }
    ?>


    <div class="centralizaConteudo">
        <main>
            <div class="containerPaiForm">
                <div class="containerBemVindo">
                    <h1>Bem Vindo!</h1>
                    <p id="marginParagrafoCadastro">Não tem nenhum cadastro?</p>
                    <p class="marginSegundoParagrafoCadastro">por favor realize seu cadastro clicando aqui abaixo</p> 
        
                    <div class="divPaiLinkCadastro">
                        <div class="divFilhoLinkCadastro" id="marginLinkCadastro">
                            <a href="../Cadastro/Cadastro.php" class="linkCadastro">Cadastrar</a>
                        </div>
                    </div>
                </div>

                <div class="containerForm">
                    <form method="post" action="">
                        <div>
                            <h1>Login</h1>
                            <p>Use seu email para entrar</p>
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
            
                            <div class="divFilhoInputLogar">
                                <input type="submit" value="Entrar" name="enviarForm">
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