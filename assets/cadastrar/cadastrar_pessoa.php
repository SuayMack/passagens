<?php

    session_start();

    ob_start();
    include_once '../conexao.php';

    $btnCadPessoa = filter_input(INPUT_POST, 'btnCadPessoa', FILTER_SANITIZE_STRING);

    if ($btnCadPessoa) {

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $result_pessoa = "INSERT INTO tbl_pessoa (nome_completo, matricula, cargo, email_pessoa, data_nascimento, cpf, rg, passaporte, celular, status_pessoa) VALUES (
            '" . $dados['nome_completo'] . "',
            '" . $dados['matricula'] . "',
            '" . $dados['cargo'] . "',
            '" . $dados['email_pessoa'] . "',
            '" . $dados['data_nascimento'] . "',
            '" . $dados['cpf'] . "',
            '" . $dados['rg'] . "',
            '" . $dados['passaporte'] . "',
            '" . $dados['celular'] . "',
            '" . $dados['status_pessoa'] . "'
            )";

        $resultado_pessoa = $conn->prepare($result_pessoa);
        $resultado_pessoa->execute();

        header("Location: cadastrar_passagem.php");

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    
    <title>Cadastro de Pessoa</title>

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
            <form method="POST" onsubmit="if(typeof fSub !== 'undefined') return false; fSub = true;">
                <h1>Cadastro de Pessoa</h1>

                <!-- Inicio Campos -->
                <div class="row">
                    <div class="col-md-8">
                        <label id="date-side" for="nome_completo">Nome Completo</label>
                        <input type="text" class="form-control" required="required" name="nome_completo"
                            id="nome_completo" maxlength="100">
                    </div>

                    <!-- Início Select Cargos -->
                    <div class="col-md-4">
                        <label id="date-side" for="cargo">Cargo</label>
                        <select class="custom-select" name="cargo" id="cargo">
                            <option selected disabled>Selecione</option>
                            <option name="cargo" value="Desembargador">Desembargador</option>
                            <option name="cargo" value="Juiz">Juiz</option>
                            <option name="cargo" value="Servidor">Servidor</option>
                            <option name="cargo" value="Estagiário">Estagiário</option>
                            <option name="cargo" value="Externo">Externo</option>
                        </select>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-5 ">
                        <label id="date-side" for="cpf">C.P.F.</label>
                        <input type="text" class="cpf form-control" name="cpf" id="cpf" required="required"
                            data-mask="000.000.000-00" data-mask-selectonfocus="true" />
                    </div>

                    <div class="col-md-4">
                        <label id="date-side" for="rg">R.G.</label>
                        <input type="text" class="form-control" name="rg" id="rg" maxlength="14">
                    </div>

                    <div class="col-md-3">
                        <label id="date-side" for="data_nascimento">Data de Nascimento</label>
                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <label id="date-side" for="email_pessoa">Email</label>
                        <input type="email" class="form-control" required="required" name="email_pessoa"
                            id="email_pessoa" maxlength="100">
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="celular">Celular</label>
                        <input type="text" class="form-control" name="celular" id="celular" data-mask="(00) 0 0000-0000" data-mask-selectonfocus="true" />
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="matricula">Matrícula</label>
                        <input type="text" class="form-control" name="matricula" id="matricula" maxlength="5">
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="passaporte">Passaporte</label>
                        <input type="text" class="form-control" name="passaporte" id="passaporte" maxlength="14">
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="submit" class="btn" id="btnCadPessoa" value="Salvar"
                            name="btnCadPessoa"></input>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="submit" class="btn" id="btnCadPessoa" value="Cancelar"></input>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="status_pessoa" id="status_pessoa" value="ativo">
                <!-- Fim Campos -->
            </form>

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

    <!-- máscaras -->
    <script src="../js/jquery.mask.min.js"></script>


</body>

</html>