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
                <form action="">

                    <div class="divContainerPaiCampos">
                        <div class="primeiraDivCamposForm">
                            
                            <div class="campos">
                                <label for="selecao">Defina:</label>
                                <select name="select" id="selecao1">
                                    <option value="op1">Entrada</option>
                                    <option value="op2">Saida</option>
                                </select>
                            </div>

                            <div class="campos">
                                <label  for="nomeProduto">Descrição:</label>
                                <input class="input" type="text" name="nomeProduto" id="texto" placeholder="Digite o nome do produto">
                            </div>

                            <div class="campos">
                                <label for="preco">Preço: </label>
                                <input type="text" name="preco" class="input" placeholder="Digite o preço atual">
                            </div>
                            <div class="campos">
                                <label for="ano">Ano: </label>
                                <input type="text" name="ano" class="input" placeholder="Digite o ano da camisa">
                            </div>
                        </div>

                        <div class="segundaDivCamposForm">
                            
                            <div class="campos">
                                <label for="select">Tamanho: </label>
                                <select name="select" id="selecao2">
                                    <option value="op1">P</option>
                                    <option value="op2">M</option>
                                    <option value="op3">G</option>
                                </select>
                            </div>
                        
                            <div class="campos">
                                <label for="Quantidade">Quantidade: </label>
                                <input class="input" type="number" name="Quantidade" id="Quantidade" placeholder="Digite a quantidade em estoque">
                            </div>

                            <div class="campos">
                                <label for="precoTotal">Preço Total: </label>
                                <input type="text" name="precoTotal" class="input" placeholder="Digite o preço total, sem descontos">
                            </div>
                            <div class="campos">
                                <label for="linha">Linha: </label>
                                <input type="text" name="linha" class="input" placeholder="Qual linha deseja modificar">
                            </div>
                        </div>
                            
                    </div>

                    <div class="divButtonsForm">
                        <input class="submit" type="submit" value="Enviar"> 
                        <input class="reset" type="reset" value="Limpar">
                    </div>

                </form>

        </section>

        <section class="sectionTable">
            <div>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Descrição</th>
                        <th>Ano</th>
                        <th>Tamanho</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Preço Total</th>
                    </tr>
                    <tr>
                        <td id="idLinha1">1</td>
                        <td id="descricaoLinha1">Barcelona</td>
                        <td id="anoLinha1">2022</td>
                        <td id="tamanhoLinha1">M</td>
                        <td id="quantidadeLinha1">120</td>
                        <td id="precoAtualLinha1">R$ 249,90</td>
                        <td id="precoTotalLinha1">R$ 29.988,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha2">2</td>
                        <td id="descricaoLinha2">Real Madrid</td>
                        <td id="anoLinha2">2022</td>
                        <td id="tamanhoLinha2">G</td>
                        <td id="quantidadeLinha2">97</td>
                        <td id="precoAtualLinha2">R$ 299,90</td>
                        <td id="precoTotalLinha2">R$ 29.090,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha3">3</td>
                        <td id="descricaoLinha3">Brasil</td>
                        <td id="anoLinha3">2022</td>
                        <td id="tamanhoLinha3">M</td>
                        <td id="quantidadeLinha3">87</td>
                        <td id="precoAtualLinha3">R$ 349,90</td>
                        <td id="precoTotalLinha3">R$ 30.441,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha4">4</td>
                        <td id="descricaoLinha4">Argentina</td>
                        <td id="anoLinha4">2022</td>
                        <td id="tamanhoLinha4">P</td>
                        <td id="quantidadeLinha4">75</td>
                        <td id="precoAtualLinha4">R$ 299,90</td>
                        <td id="precoTotalLinha4">R$ 22.492,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha5">5</td>
                        <td id="descricaoLinha5">Wolver Hampton</td>
                        <td id="anoLinha5">2022</td>
                        <td id="tamanhoLinha5">G</td>
                        <td id="quantidadeLinha5">89</td>
                        <td id="precoAtualLinha5">R$ 239,90</td>
                        <td id="precoTotalLinha5">R$ 21.351,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha6">6</td>
                        <td id="descricaoLinha6">Inglaterra</td>
                        <td id="anoLinha6">2022</td>
                        <td id="tamanhoLinha6">M</td>
                        <td id="quantidadeLinha6">113</td>
                        <td id="precoAtualLinha6">R$ 299,90</td>
                        <td id="precoTotalLinha6">R$ 33.888,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha7">7</td>
                        <td id="descricaoLinha7">Juventus</td>
                        <td id="anoLinha7">2022</td>
                        <td id="tamanhoLinha7">P</td>
                        <td id="quantidadeLinha7">98</td>
                        <td id="precoAtualLinha7">R$ 259,90</td>
                        <td id="precoTotalLinha7">R$ 25.470,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha8">8</td>
                        <td id="descricaoLinha8">Arsenal</td>
                        <td id="anoLinha8">2022</td>
                        <td id="tamanhoLinha8">G</td>
                        <td id="quantidadeLinha8">87</td>
                        <td id="precoAtualLinha8">R$ 299,90</td>
                        <td id="precoTotalLinha8">R$ 26.091,00</td>
                    </tr>
                    <tr>
                        <td id="idLinha9">9</td>
                        <td id="descricaoLinha9">Liverpool</td>
                        <td id="anoLinha9">2022</td>
                        <td id="tamanhoLinha9">G</td>
                        <td id="quantidadeLinha9">62</td>
                        <td id="precoAtualLinha9">R$ 309,90</td>
                        <td id="precoTotalLinha9">R$ 19.213,00</td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
</main>

<footer class="footer">
    <sup>©</sup>2024 - Todos os direitos Reservados
  </footer>
</body>
</html>