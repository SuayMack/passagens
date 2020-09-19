<?php

    session_start();

    include_once 'conexao.php';

    
?>
<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    <title>Cadastro de Viagem</title>

    <link rel="shortcut icon" href="img/icon.png" type="image/png">

<!-- Estilos / Formatação -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-md navbar-dark">
            <div class="header">
                <div class="logo">
                    <img src="img/logobco.png" type="image/png" width=80>
                </div>
                <div class="session">
                    <a id="session">
                        <i class="fas fa-user"></i>
                        <?php
                        if (!empty($_SESSION['id_usuario'])) {
                            echo $_SESSION['nome_completo'] . " - " . $_SESSION['matricula'];
                        } else {
                            header("Location: ../index.php");
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
                            <a class="nav-link" href="menu.php" id="navbarSupportedContent" role="button"
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
                                                <a class="dropdown-item" href="cadastrar/cadastrar_pessoa.php">Passageiro</a>
                                                <a class="dropdown-item" href="cadastrar/cadastrar_passagem.php">Passagem</a>
                                                <a class="dropdown-item" href="cadastrar/cadastrar_viagem.php">Viagem</a>
                                                
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
                                                <a class="dropdown-item" href="cadastrar/cadastrar_pagamento.php">Lançar</a>
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
                                <a class="dropdown-item" href="dashboard.php">Painel</a>
                                <a class="dropdown-item" href="consultar/consulta_aditivo.php">Aditivo</a>
                                <a class="dropdown-item" href="consultar/consulta_contrato.php">Contrato</a>
                                <a class="dropdown-item" href="consultar/consulta_item.php">Item</a>
                                <a class="dropdown-item" href="consultar/consulta_pagamento.php">Pagamento</a>
                                <a class="dropdown-item" href="consultar/consulta_pessoa.php">Passageiro</a>
                                <a class="dropdown-item" href="consultar/consulta_passagem.php">Passagem</a>
                                <a class="dropdown-item" href="consultar/consulta_viagem.php">Viagem</a>
                                
                            </div>
                        </li>

                        <!-- Menu Configurações -->

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Administrador
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="alterar_senha.php">Alterar Senha</a>
                                            <?php
                                        if ($_SESSION['funcao'] <= 2) {
                                            echo '
                                                <a class="dropdown-item" href="cadastrar/cadastrar_cidade.php">Incluir Cidade</a>
                                                
                                    ';
                        }
                        if ($_SESSION['funcao'] == 1) {
                            echo '
                                                <a class="dropdown-item" href="cadastrar/cadastrar_aditivo.php">Novo Aditivo de Valor</a>
                                                <a class="dropdown-item" href="cadastrar/cadastrar_adivigencia.php">Novo Aditivo de Prazo</a>
                                                <a class="dropdown-item" href="cadastrar/cadastrar_contrato.php">Novo Contrato</a>
                                                <a class="dropdown-item" href="cadastrar/cadastrar_item.php">Novo Item</a>
                                                <a class="dropdown-item" href="cadastrar/cadastrar_usuario.php">Novo Usuário</a>
                                    ';
                        }
                        ?>
                                            </div>							
                                        </li>

                        <!-- Menu Sair -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="sair.php">
                                <span>Sair</span>
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <?php
        if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <section class="col-md-auto">
        <div class="content-centar" id="container">
            <div class="row">
                <!-- Pagamentos em aberto -->
                <div class="col-md-5">
                        
                        <?php
                        $unidadeS = $_SESSION['unidade'];
                        $result_passageiro = "SELECT * FROM tbl_passagem
                                                            LEFT JOIN tbl_pessoa
                                                            ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
                                                            WHERE tbl_passagem.status_passagem LIKE 'ativo' 
                                                            AND tbl_passagem.pagamento IS false
                                                            AND status_passagem ILIKE 'ativo'
                                                            AND tbl_passagem.unidade = '$unidadeS'
                                                            ORDER BY data_ida";

                        $resultado_pas = $conn->prepare($result_passageiro);
                        $resultado_pas->execute();
                            echo '
                                <div class="table-overflow">
                                <table class="table table-responsive">
                                    <caption>Pagamentos em aberto</caption>
                                    <thead>
                                        <tr>
                                            <th scope="col">Passagem</th>
                                            <th scope="col">Localizador</th>
                                            <th scope="col">Passageiro</th>
                                        </tr>
                                    </thead>
                                    
                            ';
                        while ($row_passagem = $resultado_pas->fetch(PDO::FETCH_ASSOC)) {
                            echo '
                                    <tbody>
                                    <tr>
                                        
                                        <th scope="row"> <a style="color:#113141" href="cadastrar/cadastrar_pagamento.php">'.$row_passagem['id_passagem'].'</a></th>
                                        <td>'.$row_passagem['localizador'].'</td>
                                        <td>'.$row_passagem['nome_completo'].'</td>
                                       
                                    </tr>
                            ';
                              
                        }
                            echo'
                                    </tbody>
                                </table></div>';
                        ?>
                </div>
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