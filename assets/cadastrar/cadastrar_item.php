<?php
    session_start();

    ob_start();

    include_once '../conexao.php';

    $btnCadItem = filter_input(INPUT_POST, 'btnCadItem', FILTER_SANITIZE_STRING);

    if ($btnCadItem) {

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $result_item = "INSERT INTO tbl_item (id_contrato, descricao, valor_contratado, desconto_valor, comissao_valor, desconto_percentual, comissao_percentual, status_item) VALUES (
            '" . $dados['id_contrato']. "',
            '" . $dados['descricao']. "',
            '" . $dados['valor_contratado']. "',
            '" . $dados['desconto_valor']. "',
            '" . $dados['comissao_valor']. "',
            '" . $dados['desconto_percentual']. "',
            '" . $dados['comissao_percentual']. "',
            '" . $dados['status_item']. "'
            )";

        $resultado_item = $conn->prepare($result_item);
        $resultado_item->execute();

        header("Location: cadastrar_item.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    <title>Cadastro de Itens</title>

    <link rel="shortcut icon" href="../img/icon.png" type="image/png">
    
    <!-- Estilos / Formatação -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }

            if(isset($_SESSION['msgcad'])){
                echo $_SESSION['msgcad'];
                unset($_SESSION['msgcad']);
            }
            ?>

            <form method="POST" onsubmit="if(typeof fSub !== 'undefined') return false; fSub = true;">
                <!-- Inicio Campos -->
                <h1>Item de Contrato</h1>
                <div class="row">
                    <!-- Select Contrato -->
                    <div class="col-md-3">
                        <?php

                        $result_contrato = "SELECT * FROM tbl_contrato
                                                        WHERE status_contrato LIKE 'vigente'
                                                        ORDER BY id_contrato";

                        $resultado_contrato = $conn->prepare($result_contrato);
                        $resultado_contrato->execute();



                        echo '<label id="date-side" for="contrato">Contrato</label><select class="custom-select" name="id_contrato" id="id_contrato">
                                        <option disabled>Selecione</option>';

                        while ($row_contrato = $resultado_contrato->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option selected="selected" value="' . $row_contrato['id_contrato'] . '">' . $row_contrato['num_contrato'] . '</option>';
                        }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="col-md-6">
                        <label id="date-side" for="descricao">Descrição</label>
                        <select class="custom-select" name="descricao" id="inlineFormCustomSelectPref" required="required">
                            <option selected disabled>Selecione</option>
                            <option name="descricao" value="Passagem Aérea Nacional">Passagem Aérea Nacional</option>
                            <option name="descricao" value="Passagem Aérea Internacional">Passagem Aérea Internacional
                            </option>
                            <option name="descricao" value="Passagem Rodoviária Nacional">Passagem Rodoviária Nacional
                            </option>
                            <option name="descricao" value="Seguro Viagem Internacional">Seguro Viagem Internacional
                            </option>

                        </select>
                    </div>

                    <div class="col-md-3 ">
                        <label id="date-side" for="valor_contratado">Valor Total</label>
                        <input type="text" class="form-control" name="valor_contratado" id="valor_contratado" placeholder="0.00" required="required">
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-3 ">
                        <label id="date-side">Desconto em Valor Monetário R$</label>
                        <input type="text" class="form-control" name="desconto_valor" id="desconto_valor" placeholder="0.00" required="required">
                    </div>

                    <div class="col-md-3 ">
                        <label id="date-side">Desconto em Percentual %</label>
                        <input type="text" class="form-control" name="desconto_percentual" id="desconto_percentual" placeholder="0.00" required="required">
                    </div>
                    <div class="col-md-3 ">
                        <label id="date-side">Comissão em Valor Monetário R$</label>
                        <input type="text" class="form-control" name="comissao_valor" id="comissao_valor" placeholder="0.00" required="required">
                    </div>

                    <div class="col-md-3 ">
                        <label id="date-side">Comissão em Percentual %</label>
                        <input type="text" class="form-control" name="comissao_percentual" id="comissao_percentual" placeholder="0.00" required="required">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" class="btn" id="btnCadItem" value="Salvar" name="btnCadItem">
                    </div>

                    <div class="col-md-6">
                        <a href="../menu.php">
                        <button type="button" class='btn'>Cancelar</button>
                        </a>
                    </div>
                </div>
                <input type="hidden" name="status_item" id="status_item" value="ativo">
                <!-- Fim Campos -->
            </form>

        </div>
        </div>
        </div>
    </section>
    <footer>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
        </div>
    </footer>

    <!-- menu dropdown -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
        
    <!-- aparência e menu dropdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    
</body>

</html>