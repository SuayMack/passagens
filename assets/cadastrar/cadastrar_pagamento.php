<?php
    session_start();

    ob_start();

    include '../conexao.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    <title>Pagamentos</title>

    <!-- Select com Autocomplete -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
            <form method="GET" action="../confirmar/confirmar_pagamento.php">
                <h1>Cadastrar Pagamento</h1>
                <div class="row">
                    <!-- Select Passageiro -->
                    <div class="col-md-6">
                        <?php
                        $unidadeS = $_SESSION['unidade'];

                        $result_passageiro = "SELECT * FROM tbl_passagem
                                        LEFT JOIN tbl_pessoa ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
                                        WHERE tbl_passagem.status_passagem LIKE 'ativo' AND tbl_passagem.pagamento IS false AND tbl_passagem.unidade = '$unidadeS' 
                                        ORDER BY id_passagem";

                        $resultado_passageiro = $conn->prepare($result_passageiro);
                        $resultado_passageiro->execute();

                        echo
                            '<label id="date-side" for="id_passagem">Passagem</label>
                                        <select class="custom-select" name="id_passagem" id="id_passagem">
                                        <option selected="selected" disabled>Pesquise por localizador ou nome do passageiro</option>';
                        while ($row_passageiro = $resultado_passageiro->fetch(PDO::FETCH_ASSOC)) {

                            echo '<option name="id_passagem" value="' . $row_passageiro['id_passagem'] . '">' . $row_passageiro['id_passagem'] . ' - ' . $row_passageiro['nome_completo'] . ' - Loc.' . $row_passageiro['localizador'] . ' - ' . $row_passageiro['origem'] . '/' . $row_passageiro['destino'] . '</option>';
                        }
                        echo '</select>';

                        ?>
                    </div>
                    <div class="col-md-4">
                        <label id="date-side" for="protocolo_pagamento">Protocolo do Pagamento</label>
                        <input type="text" class="  form-control" name="protocolo_pagamento" id="protocolo_pagamento"
                            maxlength="25" pattern="[0-9]{7}-[0-9]{2}.[0-9]{4}.[8]{1}.[1-6]{2}.[0-6]{4}$"
                            placeholder="0000000-00.0000.8.16.6000" data-mask="0000000-00.0000.8.16.6000"
                            data-mask-selectonfocus="true" required="required">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="comprovante">Comprovantes</label>
                        <input type="text" class="form-control" name="comprovante" id="comprovante" placeholder="Documento SEI"
                            required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label id="date-side" for="total_fatura">Valor na Fatura R$</label>
                        <input type="text" min="" step="any" class="form-control" name="total_fatura" id="total_fatura"
                            maxlength="10" placeholder="0.00" required="required">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="nota_fiscal">Nota Fiscal</label>
                        <input type="text" class="  form-control" name="nota_fiscal" id="nota_fiscal" maxlength="10"
                            required="required">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="doc_notafiscal">SEI Nota Fiscal</label>
                        <input type="number" class="form-control" name="doc_notafiscal" id="doc_notafiscal" placeholder="Documento SEI"
                            required="required" data-mask="0000000" data-mask-selectonfocus="true" />
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="fatura">Fatura</label>
                        <input type="text" class="  form-control" name="fatura" id="fatura" maxlength="10">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="doc_fatura">SEI Fatura</label>
                        <input type="number" class="form-control" name="doc_fatura" id="doc_fatura" placeholder="Documento SEI"
                            required="required" data-mask="0000000" data-mask-selectonfocus="true" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input type="submit" class="btn" id="btnCadPagamento" value="Processar"
                            name="btnCadPagamento"></input>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="btn" id="btnCancela" value="Cancelar" onclick="javascript: location.href='../menu.php';"></input>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="btn" id="btnConcluir" value="Concluir" onclick="javascript: location.href='../docs/atesto_geral.php';"></input>
                    </div>
                </div>
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
        $('#id_passagem').select2();
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