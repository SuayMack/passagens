<?php

    session_start();

    ob_start();

    include_once '../conexao.php';

    $btnCadPassagem = filter_input(INPUT_POST, 'btnCadPassagem', FILTER_SANITIZE_STRING);


    if ($btnCadPassagem) {

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $result_passagem = "INSERT INTO tbl_passagem (id_viagem, id_pessoa, id_item, origem, destino, data_ida, data_retorno, companhia, localizador, tarifa_voucher, taxas_voucher, classe, status_passagem, id_contrato, id_usuario, unidade, grau, despacho, bilhete, obs_passagem, multdestino, destinoadicional)VALUES (
            '" . $dados['id_viagem'] . "',
            '" . $dados['id_pessoa'] . "',
            '" . $dados['id_item'] . "',
            '" . $dados['origem'] . "',
            '" . $dados['destino'] . "',
            '" . $dados['data_ida'] . "',
            '" . $dados['data_retorno'] . "',
            '" . $dados['companhia'] . "',
            '" . $dados['localizador'] . "',
            '" . $dados['tarifa_voucher'] . "',
            '" . $dados['taxas_voucher'] . "',
            '" . $dados['classe'] . "',
            '" . $dados['status_passagem'] . "',
            '" . $dados['id_contrato'] . "',
            '" . $_SESSION['id_usuario'] . "',
            '" . $_SESSION['unidade'] . "',
            '" . $dados['grau'] . "',
            '" . $dados['despacho'] . "',
            '" . $dados['bilhete'] . "',
            '" . $dados['obs_passagem'] . "',
            '" . $dados['multdestino'] . "',
            '" . $dados['destinoadicional'] . "'

            )";


        $resultado_passagem = $conn->prepare($result_passagem);
        $resultado_passagem->execute();

        header("Location: cadastrar_passagem.php");
    }
    if(isset($_POST['btnConcluir'])){
        header("Location: ../confirmar/confirmar_passagem.php");
     }
     if(isset($_POST['btnCancelar'])){
        header("Location: ../menu.php");
     }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    
    <title>Cadastro de Passagem</title>

    <link rel="shortcut icon" href="../img/icon.png" type="image/png">

    <!-- Select com Autocomplete -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    

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

            if (isset($_SESSION['msgcad'])) {
                echo $_SESSION['msgcad'];
                unset($_SESSION['msgcad']);
            }
            ?>

            <form method="POST" onsubmit="if(typeof fSub !== 'undefined') return false; fSub = true;">

                <h1>Passagem</h1>

                <div class="row">
                    <!-- Select Viagem -->
                    <div class="col-md-3">
                        <?php
                        $result_viagem = "SELECT id_viagem, protocolo_compra FROM tbl_viagem
                                        ORDER BY id_viagem DESC";

                        $resultado_viagem = $conn->prepare($result_viagem);
                        $resultado_viagem->execute();

                        echo
                            '<label id="date-side" for="id_viagem">Protocolo da Viagem</label>
                                        <select class="custom-select" name="id_viagem" id="id_viagem" required="required">
                                        <option selected="selected" disabled>Pesquisar</option>';
                        while ($row_viagem = $resultado_viagem->fetch(PDO::FETCH_ASSOC)) {

                            echo '<option value="' . $row_viagem['id_viagem'] . '">' . $row_viagem['protocolo_compra'] . '</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>
                    <!-- Select Passageiro -->
                    <div class="col-md-5">
                        <?php
                        $result_pessoa = "SELECT id_pessoa, nome_completo
                                        FROM tbl_pessoa
                                        ORDER BY nome_completo ASC";

                        $resultado_pessoa = $conn->prepare($result_pessoa);
                        $resultado_pessoa->execute();

                        echo
                            '<label id="date-side" for="id_pessoa">Passageiro</label>
                                        <select class="custom-select" name="id_pessoa" id="id_pessoa" required="required">
                                        <option selected="selected" disabled>Pesquisar</option>';
                        while ($row_pessoa = $resultado_pessoa->fetch(PDO::FETCH_ASSOC)) {

                            echo '<option value="' . $row_pessoa['id_pessoa'] . '">' . $row_pessoa['nome_completo'] . '</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>

                    <!-- despacho autorizaçao -->
                    <div class="col-md-2">
                        <label id="date-side" for="despacho">Autorização</label>
                        <input type="number" class="form-control" name="despacho" id="despacho" placeholder="Documento SEI"
                            required="required" data-mask="0000000" data-mask-selectonfocus="true" />
                    </div>
                    <!-- doc sei voucher -->
                    <div class="col-md-2">
                        <label id="date-side" for="bilhete">Bilhete (Voucher)</label>
                        <input type="number" class="form-control" name="bilhete" id="bilhete" placeholder="Documento SEI"
                            required="required" data-mask="0000000" data-mask-selectonfocus="true" />
                    </div>
                </div>
                <div class="row">
                    <!-- Início Select Grau -->
                    <div class="col-md-2">
                        <label id="date-side" for="grau">Grau</label>
                        <select class="custom-select" name="grau" id="inlineFormCustomSelectPref">
                            <option selected enabled name="grau" value="2º">2º Grau</option>
                            <option name="grau" value="1º">1º Grau</option>
                        </select>
                    </div>
                    <!-- Select Contrato -->
                    <div class="col-md-2">
                        <?php
                        $result_contrato = "SELECT id_contrato, num_contrato
                                        FROM tbl_contrato
                                        WHERE tbl_contrato.status_contrato LIKE 'vigente'
                                        ORDER BY id_contrato";

                        $resultado_contrato = $conn->prepare($result_contrato);
                        $resultado_contrato->execute();

                        echo
                            '<label id="date-side" for="id_contrato">Contrato</label>
                                        <select class="custom-select" name="id_contrato" id="id_contrato">
                                        <option disabled>Selecione</option>';
                        while ($row_contrato = $resultado_contrato->fetch(PDO::FETCH_ASSOC)) {

                            echo '<option selected="selected"  value="' . $row_contrato['id_contrato'] . '">' . $row_contrato['num_contrato'] . '</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>
                    <!-- Select Item -->
                    <div class="col-md-3">
                        <?php
                        $result_item = "SELECT id_item, descricao
                                        FROM tbl_item
                                        WHERE tbl_item.status_item LIKE 'ativo'
                                        ORDER BY id_item";

                        $resultado_item = $conn->prepare($result_item);
                        $resultado_item->execute();

                        echo
                            '<label id="date-side" for="id_item">Tipo</label>
                                        <select class="custom-select" name="id_item" id="id_item">
                                        <option selected="selected" disabled>Selecionar</option>';
                        while ($row_item = $resultado_item->fetch(PDO::FETCH_ASSOC)) {

                            echo '<option value="' . $row_item['id_item'] . '">' . $row_item['descricao'] . '</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="classe">Classe</label>
                        <select class="custom-select" name="classe" id="classe">
                            <option value="normal" selected enabled>Normal</option>
                            <option value="cúpula">Cúpula</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label id="date-side" for="multdestino">Mult/Dest?</label>
                        <select class="custom-select" name="multdestino" id="multdestino">
                            <option selected enabled>Não</option>
                            <option>Sim</option>
                        </select>  
                    </div>
                    <div class="col-md-2" id="inputOculto">
                        <label id="date-side" for="destinoadicional">Trecho Completo</label>
                        <input class="form-control" type="text" name="destinoadicional" placeholder="CWB/SAO/BSB/CWB">
                    </div>
                </div>
                <div class="row">
                    <!-- Select Origem -->
                    <div class="col-md-3">
                        <?php
                        $result_cidade = "SELECT origem, destino
                                        FROM tbl_cidade
                                        ORDER BY origem ASC";

                        $resultado_cidade = $conn->prepare($result_cidade);
                        $resultado_cidade->execute();

                        echo
                            '<label id="date-side" for="origem">Origem</label>
                                        <select class="custom-select" name="origem" id="origem" required="required">
                                        <option selected="selected" disabled>Pesquisar</option>';
                        while ($row_origem = $resultado_cidade->fetch(PDO::FETCH_ASSOC)) {

                            echo '<option name="origem" value="' . $row_origem['origem'] . '">' . $row_origem['origem'] . '</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="data_ida">Data de Ida</label>
                        <input type="date" class="form-control" name="data_ida" id="data_ida" required="required">
                    </div>
                    <div class="col-md-3">
                        <?php
                        $resultado_cidade = $conn->prepare($result_cidade);
                        $resultado_cidade->execute();
                        echo
                            '<label id="date-side" for="destino">Destino</label>
                                        <select class="custom-select" name="destino" id="destino" required="required">
                                        <option selected="selected">Pesquisar</option>';
                        while ($row_destino = $resultado_cidade->fetch(PDO::FETCH_ASSOC)) {

                            echo '<option value="' . $row_destino['destino'] . '">' . $row_destino['destino'] . '</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="data_retorno">Data de Retorno</label>
                        <input type="date" class="form-control" name="data_retorno" id="data_retorno">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 ">
                        <label id="date-side" for="tarifa_voucher">Passagem / Seguro R$</label>
                        <input type="number" min="0.01" step="0.01" class="form-control" name="tarifa_voucher"
                            id="tarifa_voucher" required="required">
                    </div>
                    <div class="col-md-3 ">
                        <label id="date-side" for="taxas_voucher">Taxas R$</label>
                        <input type="number" step="0.01" class="form-control" name="taxas_voucher"
                            id="taxas_voucher" required="required">
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="companhia">Companhia / Seguradora</label>
                        <input type="text" class="form-control" name="companhia" id="companhia" maxlength="48"
                            required="required">
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="localizador">Localizador / Apólice</label>
                        <input type="text" class="form-control" name="localizador" id="localizador" maxlength="15"
                            required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        	<label id="date-side" for="obs_passagem">Observações</label>
                        <textarea class="form-control" id="obs_passagem" name="obs_passagem" rows="2" maxlength="499"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="submit" class="btn" id="btnCadPassagem" value="Salvar"
                            name="btnCadPassagem"></input>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="btn" name="btnCancelar" value="Cancelar" formnovalidate></input>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="btn" name="btnConcluir" value="Concluir" formnovalidate></input>
                    </div>




                    <input type="hidden" class="form-control" name="status_passagem" id="status_passagem" value="ativo">
                    <!-- Fim Campos -->
            </form>
        </div>
    </section>
    <footer>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
        </div>
    </footer>

    <!-- função select com autocomplete -->
    <script>
    $(document).ready(function() {
        $('#id_pessoa').select2();
        $('#id_viagem').select2();
        $('#origem').select2();
        $('#destino').select2();
    });
    </script>

    <!-- aparência e menu dropdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
  
    <!-- máscaras -->
    <script src="../js/jquery.mask.min.js"></script>


</body>

</html>