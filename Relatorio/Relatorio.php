<?php 
    session_start();

    include_once('../../Model/conexao.php');

?>

<?php
 
    $dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

if(!empty($dados['Enviar']))
{

if($dados['selecao'] == "entrada" || $dados['selecao'] == "saida" ){
    $empty_input= false;
    $dados = array_map('trim', $dados);

    if (!empty($dados['preco'])) {
    // Substitui vírgula por ponto para armazenar no banco de dados 
        $dados['preco'] = str_replace(',', '.', $dados['preco']);
    }

   
    if($dados['modelo'] == "" || $dados['ano'] == "" || $dados['tamanho'] == "" || $dados['preco'] == "" || $dados['quantidade'] == "" ){
    // Verifica se algum campo obrigatório está vazio
        $empty_input = true;
        echo "<p style='color: red'>ERRO:Existem campos obrigatorios* em branco </p> <br>";
    }

    if($empty_input == false){


        $quantidade = $dados['quantidade'];
        if ($dados['selecao'] == "saida") {
        // Se for saída, torna a quantidade negativa
            $quantidade *= -1;
        }
    

        // Consulta para verificar se a camisa já existe no banco de dados
        $queryVerificarCamisa  = "SELECT idcamisa, quantidade FROM projeto.camisas WHERE modelo = :modelo AND ano = :ano AND tamanho = :tamanho";
        $verificarCamisa  = $pdo->prepare($queryVerificarCamisa);
        $verificarCamisa->execute([
            ':modelo' => $dados['modelo'],
            ':ano' => $dados['ano'],
            ':tamanho' => $dados['tamanho']
        ]);

        if ($verificarCamisa->rowCount() > 0) 
        {
        // Se a camisa já existe
            $camisaExistente = $verificarCamisa->fetch(PDO::FETCH_ASSOC);
            $novaQuantidade = $camisaExistente['quantidade'] + $quantidade;

            
        // Verificar se a quantidade não ficará negativa    
            if ($novaQuantidade < 0) {
                echo "<p style='color: red'>ERRO: A operação resultaria em uma quantidade negativa</p><br>";
            }
            else
            {
                // Atualizar a quantidade da camisa existente
                $queryAtualizarQuantidade = "UPDATE projeto.camisas SET quantidade = :quantidade WHERE idcamisa = :idcamisa";
                $atualizarQuantidade = $pdo->prepare($queryAtualizarQuantidade);
                $atualizarQuantidade->execute([
                    ':quantidade' => $novaQuantidade,
                    ':idcamisa' => $camisaExistente['idcamisa']
                ]);

                echo "<p style='color: green'>Quantidade da camisa atualizada com sucesso</p><br>";
            }
        }   
        else 
        {
        // Se a camisa não existe, insere uma nova camisa
            $queryCamisa = "INSERT INTO projeto.camisas (modelo, ano, tamanho, preco, quantidade) VALUES (
                '" . $dados['modelo'] . "', 
                '" . $dados['ano'] . "', 
                '" . $dados['tamanho'] . "', 
                '" . $dados['preco'] . "', 
                '" . $dados['quantidade'] . "'
            )";

            $cadCamisa = $pdo->prepare($queryCamisa);
            $cadCamisa->execute();

            
            // Verificar se a inserção foi bem-sucedida
            if ($cadCamisa->rowCount()) {
                echo "<p style='color: green'>Camisa cadastrada com sucesso</p><br>";
                unset($dados);
            } else {
                echo "<p style='color: red'>ERRO: Camisa não cadastrada</p><br>";
            }
            
        }
        unset($dados);//garante o unset de dados
}
}
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrabalhoWeb</title>
    <link rel="stylesheet" href="./Relatorio.css">
</head>
<body>
    <header> 
        <nav> 
            <h1 class="tituloSite">FIVE SPORTS</h1> 

            <ul class="menu_container">
                <li class="menu__item"><a class="menu__link" href ="../Home/Home.php" >Home</a></li>
                <li class="menu__item"><a class="menu__link" href="../Feed/Feed.php" >Feed</a></li>
                <li class="menu__item"><a class="menu__link" href="../Relatorio/Relatorio.php" >Relatório</a></li>
                <li class="menu__item"><a class="menu__link" href="../Cadastro/Cadastro.php" >Cadastro/Login</a></li>
                <li class="menu__item"><a class="menu__linkSair" href="../../Controller/sair.php" >Sair</a></li>
            </ul> 
        </nav> 
    </header>
<main>
    <h2 class="tituloRelatorio">Relatórios</h2>

    <div class="containerPaiPag">
        <section class="section">
                <form action="" method="post">

                    <div class="divContainerPaiCampos">
                        <div class="primeiraDivCamposForm">
                            
                            <div class="campos">
                                <label for="selecao">Entrada ou Saida*:</label>
                                <select name="selecao" id="selecao1">
                                    <option value="entrada">Entrada</option>
                                    <option value="saida">Saida</option>
                                </select>
                            </div>

                            <div class="campos">
                                <label  for="modelo">Modelo*:</label>
                                <input class="input" type="text" name="modelo" id="texto" placeholder="Digite o nome do produto">
                            </div>

                            <div class="campos">
                                <label for="preco">Preço*: </label>
                                <input type="text" name="preco" class="input" placeholder="Digite o preço atual">
                            </div>
                            <div class="campos">
                                <label for="ano">Ano*: </label>
                                <input type="text" name="ano" class="input" placeholder="Digite o ano da camisa">
                            </div>
                        </div>

                        <div class="segundaDivCamposForm">
                            
                            <div class="campos">
                                <label for="select">Tamanho*: </label>
                                <select name="tamanho" id="selecao2">
                                    <option value="P">P</option>
                                    <option value="M">M</option>
                                    <option value="G">G</option>
                                </select>
                            </div>
                        
                            <div class="campos">
                                <label for="Quantidade">Quantidade*: </label>
                                <input class="input" type="number" name="quantidade" id="Quantidade" placeholder="Digite a quantidade em estoque">
                            </div>
                        </div>
                            
                    </div>

                    <div class="divButtonsForm">
                        <input class="submit" type="submit" value="Enviar" name="Enviar"> 
                        <input class="reset" type="reset" value="Limpar">
                    </div>

                </form>

        </section>
        <section class="sectionTable">
        <?php 
            $queryUsuario = "SELECT idcamisa, modelo, ano, tamanho, preco, quantidade FROM projeto.camisas";
            $result = $pdo->prepare($queryUsuario);
            $result->execute();

        if ($result->rowCount() != 0) {
        ?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descrição</th>
                    <th>Ano</th>
                    <th>Tamanho</th>
                    <th>Preço</th>
                    <th>Peças em Estoque</th>
                    <th>Valor em Estoque</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            while ($rowTable = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td><?php echo $rowTable['idcamisa']; ?></td>
                    <td><?php echo $rowTable['modelo']; ?></td>
                    <td><?php echo $rowTable['ano']; ?></td>
                    <td><?php echo $rowTable['tamanho']; ?></td>
                    <td><?php echo 'R$ ' . number_format($rowTable['preco'], 2, ',', '.');  ?></td>
                    <td><?php echo $rowTable['quantidade']; ?></td>
                    <td><?php echo 'R$ ' . number_format(($rowTable['quantidade'] * $rowTable['preco'] ), 2, ',', '.'); ?></td>
                </tr>
            <?php 
            }
            ?>
            </tbody>
        </table>
    <?php 
    }
    else{
        echo "<p style='color: red'>Estoque vazio!</p> <br>";
    }
    ?>
    </section>




        </div>
    </section>
</div>
</main>

<footer class="footer">
    <sup>©</sup>2024 - Todos os direitos Reservados
  </footer>
</body>
</html>