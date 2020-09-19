<?php

session_start();

ob_start();

include_once '../conexao.php';

// encontrar id passagem
$result_ultimo = "SELECT MAX(id_passagem) AS id_passagem FROM tbl_passagem INNER JOIN tbl_viagem
    ON tbl_passagem.id_viagem = tbl_viagem.id_viagem";
$resultado_ultimo = $conn->prepare($result_ultimo);
$resultado_ultimo->execute();
$row_ultimo = $resultado_ultimo->fetch(PDO::FETCH_ASSOC);
$idpassagem = $row_ultimo['id_passagem'];

// encontrar id viagem
$result_viagem = "SELECT id_viagem FROM tbl_passagem
                    WHERE id_passagem = $idpassagem";
$resultado_viagem = $conn->prepare($result_viagem);
$resultado_viagem->execute();
$row_viagem = $resultado_viagem->fetch(PDO::FETCH_ASSOC);
$idviagem  = $row_viagem['id_viagem'];


$btnConfirmaPassagem = filter_input(INPUT_GET, 'btnConfirmaPassagem', FILTER_SANITIZE_STRING);

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->

    <title>Cofirmar Passagem</title>

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
            <form method="GET" action="../docs/informa_passagem.php">
                <h1>Confirmar Passagem</h1>
                <div class="row">
                    <div class="col-md-12">
                        <?php

                            // montar lista de passagens compradas para a viagem
                            $result_passagem =
                                "SELECT * FROM tbl_passagem
                                LEFT JOIN tbl_pessoa
                                ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
                                LEFT JOIN tbl_viagem
                                ON tbl_passagem.id_viagem = tbl_viagem.id_viagem
                                LEFT JOIN tbl_item
                                ON tbl_passagem.id_item = tbl_item.id_item
                                WHERE tbl_passagem.id_viagem = $idviagem AND tbl_passagem.status_passagem ILIKE 'ativo'";

                                $resultado_passagem = $conn->prepare($result_passagem);
                                $resultado_passagem->execute();
                                echo'
                                <div class="table-overflow">
                                    <table class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th scope="col">Viagem</th>
                                                <th scope="col">Passagem</th>
                                                <th scope="col">&nbsp &nbspPassageiro</th>
                                                <th scope="col">Tipo de Passagem</th>
                                                <th scope="col">Loc.</th>
                                                <th scope="col">Tarifa R$</th>
                                                <th scope="col">Taxas R$</th>
                                                <th scope="col">Origem</th>
                                                <th scope="col">destino</th>
                                                <th scope="col">Ida</th>
                                                <th scope="col">Retorno</th>
                                                <th scope="col"></th>
    
                                            </tr>
                                        </thead>
                                ';

                                while ($row_passagem = $resultado_passagem->fetch(PDO::FETCH_ASSOC)) {
                                    $idpassagem = $row_passagem['id_passagem'];
                                    $idviagem = $row_passagem['id_viagem'];
                                    $passageiro = $row_passagem['nome_completo'];
                                    $tarifa = $row_passagem['tarifa_voucher'];
                                    $taxas = $row_passagem['taxas_voucher'];
                                    $item = $row_passagem['descricao'];
                                    $localizador = $row_passagem['localizador'];
                                    $origem = $row_passagem['origem'];
                                    $destino = $row_passagem['destino'];
                                    $ida = $row_passagem['data_ida'];
                                    $retorno = $row_passagem['data_retorno'];
                                echo'
                                        <tbody>
                                            <tr>
                                                <th scope="row">'.$idviagem.'</th>
                                                <td>'.$idpassagem.'</td>
                                                <td>'.$passageiro.'</td>
                                                <td>'.$item.'</td>
                                                <td>'.$localizador.'</td>
                                                <td>'.$tarifa.'</td>
                                                <td>'.$taxas.'</td>
                                                <td>'.$origem.'</td>
                                                <td>'.$destino.'</td>
                                                <td>'.$ida.'</td>
                                                <td>'.$retorno.'</td>
                                                <td><strong><a style="color:#123141" href="../editar/editar_passagem.php?id_passagem='.$row_passagem['id_passagem'].'">Editar</a></strong></td>
                                            </tr>   
                                        </tbody>
                                    
                                    '; 
                                }
                                echo'
                                </table></div>';
                        ?>
                    </div>
                </div>
                <input type="hidden" id="id_viagem" name="id_viagem" value="<?=$idviagem;?>">
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" class="btn" id="btnConfirmaPassagem" value="Confirmar Viagem"></input>
                    </div>
                </div>                
        </div>
    </section>
    <footer>
        <div class=" footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
        </div>
    </footer>
</body>

</html>