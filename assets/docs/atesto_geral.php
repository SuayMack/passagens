<?php
    session_start();

    ob_start();

    include_once '../conexao.php';

    $result_ultimo = "SELECT MAX(id_pagamento) AS id_pagamento FROM tbl_pagamento INNER JOIN tbl_passagem
        ON tbl_pagamento.id_passagem = tbl_passagem.id_passagem";
    $resultado_ultimo = $conn->prepare($result_ultimo);
    $resultado_ultimo->execute();
    $row_pagamento = $resultado_ultimo->fetch(PDO::FETCH_ASSOC);

        $ultimo = $row_pagamento['id_pagamento'];

    $btnCadPagamento = filter_input(INPUT_POST, 'btnCadPagamento', FILTER_SANITIZE_STRING);
    $btnConcluir = filter_input(INPUT_POST, 'btnConcluir', FILTER_SANITIZE_STRING);

    if ($btnCadPagamento) {
        header("Location: cadastrar/cadastrar_pagamento.php");
    }
    if ($btnConcluir) {
        header("Location: ../menu.php");
    }

    $result_passagem =
        "SELECT * FROM tbl_pagamento
                                        INNER JOIN tbl_passagem
                                        ON tbl_pagamento.id_passagem = tbl_passagem.id_passagem
                                        INNER JOIN tbl_viagem
                                        On tbl_passagem.id_viagem = tbl_viagem.id_viagem
                                        INNER JOIN tbl_contrato
                                        ON tbl_passagem.id_contrato = tbl_contrato.id_contrato
                                        WHERE tbl_pagamento.id_pagamento = $ultimo";

    $resultado_passagem = $conn->prepare($result_passagem);
    $resultado_passagem->execute();
    $resultado_passagem->execute();
    while ($row_passagem = $resultado_passagem->fetch(PDO::FETCH_ASSOC)) {
        $notafiscal = $row_passagem['nota_fiscal'];
        $fatura = $row_passagem['fatura'];
        $protocolocompra = $row_passagem['protocolo_compra'];
        $grau = $row_passagem['grau'];
        $numcontrato = $row_passagem['num_contrato'];
        $empresa = $row_passagem['contratada'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->

    <title>Atesto</title>

    <link rel="shortcut icon" href="../img/icon.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- icones 'usuario' 'inicio' e 'sair' -->
<link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css"> 
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-md navbar-dark">
            <div class="header">
                <div class="logo">
                    <img src="../img/logobco.png" type="image/png" width=80>
                </div>
                <div class="session">
                    <a id="session">
                        <i class="fas fa-user"></i>
                        <?php
                        if (!empty($_SESSION['id_usuario'])) {
                            echo $_SESSION['nome_completo'] . " - " . $_SESSION['matricula'];
                        } else {
                            header("Location: ../../index.php");
                        }
                        ?>
                    </a>
                </div>
                <!--Logo-->
                <div class="buttonHamb">
                    <!--Menu Hamburger-->
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#nav-target">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <!--navegação-->
                <div class="collapse navbar-collapse" id="nav-target">
                    <ul class="navbar-nav ml-auto">

                        <!-- início -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="../menu.php" id="navbarSupportedContent" role="button"
                                aria-haspopup="true" aria-expanded="false" style="margin-right:.5rem">
                                <i class="fas fa-home"></i>
                                Início
                            </a>
                        </li>

                        <!-- Menu Cadastrar -->
                        <?php
                        if ($_SESSION['funcao'] <= 2) {
                            echo '                            
                                        <li class="nav-item dropdown">                            
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarSupportedContent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Cadastrar
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_pessoa.php">Passageiro</a>
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_passagem.php">Passagem</a>
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_viagem.php">Viagem</a>
                                                
                                    ';
                        }
                        ?>
                        <?php
                        if ($_SESSION['funcao'] <= 2) {
                            echo '
                                        <!--Menu Pagamento -->
                                        <li class="nav-item dropdown">                            
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarSupportedContent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Pagamento
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_pagamento.php">Lançar</a>
                                            </div>
                                        </li>
                                    ';
                        }
                        ?>
                                                
                        <!-- Menu Consultar -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarSupportedContent" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Consultar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../dashboard.php">Painel</a>
                                <a class="dropdown-item" href="../consultar/consulta_aditivo.php">Aditivo</a>
                                <a class="dropdown-item" href="../consultar/consulta_contrato.php">Contrato</a>
                                <a class="dropdown-item" href="../consultar/consulta_item.php">Item</a>
                                <a class="dropdown-item" href="../consultar/consulta_pagamento.php">Pagamento</a>
                                <a class="dropdown-item" href="../consultar/consulta_pessoa.php">Passageiro</a>
                                <a class="dropdown-item" href="../consultar/consulta_passagem.php">Passagem</a>
                                <a class="dropdown-item" href="../consultar/consulta_viagem.php">Viagem</a>
                                
                            </div>
                        </li>

                        <!-- Menu Configurações -->

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Administrador
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="../alterar_senha.php">Alterar Senha</a>
                                            <?php
                                        if ($_SESSION['funcao'] <= 2) {
                                            echo '
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_cidade.php">Incluir Cidade</a>
                                                
                                    ';
                        }
                        if ($_SESSION['funcao'] == 1) {
                            echo '
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_aditivo.php">Novo Aditivo de Valor</a>
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_adivigencia.php">Novo Aditivo de Prazo</a>
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_contrato.php">Novo Contrato</a>
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_item.php">Novo Item</a>
                                                <a class="dropdown-item" href="../cadastrar/cadastrar_usuario.php">Novo Usuário</a>
                                    ';
                        }
                        ?>
                                            </div>							
                                        </li>

                        <!-- Menu Sair -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="../sair.php">
                                <span>Sair</span>
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>



    <section class="col-md-auto">
        <div class="content-center" id="container">
            <div style="text-align: center">
                <b>ATESTO DE RECEBIMENTO</b><br><br><br>
            </div>
            <div style="text-align: justify; margin: 0 3rem 0 3rem">
                <b>I.</b> Pelo presente termo, atesta-se que os serviços constantes da nota fiscal eletrônica n.º <b>
                    <?= $notafiscal; ?> </b>e fatura n.º <b> <?= $fatura; ?> </b>foram efetuados em proveito do Poder
                Judiciário Paranaense e em conformidade com solicitação feita por este setor, dentro dos parâmetros e
                prazos estabelecidos pelo contrato n.º <b><?= $numcontrato; ?></b> com a empresa<b>
                    <?= $empresa; ?></b>.<br>
                <b>II.</b> Foi relacionado ao presente o protocolo<b> SEI n.º <?= $protocolocompra; ?></b>, no qual
                consta o despacho de indicação e de autorização de compra das passagens, bem como as passagens e os
                respectivos comprovantes de embarque.<br>
                <b>III.</b> Considerando o disposto na Resolução nº 195, de 03 de junho de 2014, do Conselho Nacional de
                Justiça, informa-se que esta despesa e feita em favor do<b> <?= $grau; ?> grau de jurisdição</b>.<br>
                <b>IV.</b> Encaminha-se o presente para a Divisão de Controle de Contratos e Atas de Registro de Preços
                para devidos fins.<br>
                Curitiba, data da assinatura eletrônica.
                <br><br>
            </div>
            <div style="text-align: center; text-transform: uppercase">
                <b><?= $_SESSION['nome_completo']; ?></b>
            </div>
            <div style="text-align: center">
                <?php
                if ($_SESSION['unidade'] <> 1) {
                    echo 'Seção de Análise de Requisições<br><br> 
                            <div style="text-align: left; margin: 0 3rem 0 3rem"> 
                            <b>I</b> - Visto;<br>
                            <b>II</b> - De acordo;<br>
                            <b>III</b> - Encaminhe-se à DP-DCA.<br>
                            Documento datado e assinado eletronicamente.<br><br>
                            </div>
                            <div style="text-align: center">
                            <b>ESTELA COSTA</></b><br>
                            Chefe da Divisão de Análise e Gerenciamento de Requisições<br>
                            Departamento do Patrimônio
                            </div>';
                } else {
                    echo 'Departamento de Comunicação e Cerimonial';
                }
                ?>
            </div>
            <form method="POST" onsubmit="if(typeof fSub !== 'undefined') return false; fSub = true;">
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" class="btn" id="btnCadPagamento" name="btnCadPagamento" value="Lançar novo pagamento">
                    </div>
                    <div class="col-md-6">
                        <input type="submit" class="btn" id="btnConcluir" name="btnConcluir" value="Concluir">
                    </div>
                </div>
            </form>
        </div>

    </section>
    <footer>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
        </div>
    </footer>

    <!-- menu dropdown -->
    <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
    <!-- aparência e menu dropdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>