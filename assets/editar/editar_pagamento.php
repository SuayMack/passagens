<?php
session_start();

include_once '../conexao.php';

$id_pagamento = filter_input(INPUT_GET, 'id_pagamento', FILTER_SANITIZE_NUMBER_INT);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    <title>Editar Pagamento</title>

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
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
        //SQL para selecionar o registro
    $result_msg_cont = "SELECT * FROM tbl_pagamento 
    LEFT JOIN tbl_passagem
    ON tbl_pagamento.id_passagem = tbl_passagem.id_passagem
    LEFT JOIN tbl_pessoa
    ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
    WHERE id_pagamento = $id_pagamento";

        //Seleciona os registros
    $resultado_msg_cont = $conn->prepare($result_msg_cont);
    $resultado_msg_cont->execute();
    $row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC);

    ?>
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
                        if(!empty($_SESSION['id_usuario'])){
                            echo $_SESSION['nome_completo']." - ".$_SESSION['matricula'];
                        }else{
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
                            <a class="nav-link" href="../menu.php" id="navbarSupportedContent" role="button" aria-haspopup="true" aria-expanded="false" style="margin-right:.5rem">
                                <i class="fas fa-home"></i>
                                Início
                            </a>
                        </li>

                        <!-- Menu Cadastrar -->
                        <?php
                        if($_SESSION['funcao'] < 3){
                            echo '                            
                            <li class="nav-item dropdown">                            
                            <a class="nav-link dropdown-toggle" href="#" id="navbarSupportedContent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cadastrar
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../cadastrar/cadastrar_viagem.php">Viagem</a>
                            <a class="dropdown-item" href="../cadastrar/cadastrar_passagem.php">Passagem</a>
                            <a class="dropdown-item" href="../cadastrar/cadastrar_pessoa.php">Passageiro</a>
                            ';
                        }
                        if ($_SESSION['funcao'] == 1){
                            echo '
                            <a class="dropdown-item" href="../cadastrar/cadastrar_contrato.php">Contrato</a>
                            <a class="dropdown-item" href="../cadastrar/cadastrar_aditivo.php">Aditivo</a>
                            ';
                        }
                        ?>
                        <?php
                        if($_SESSION['funcao'] < 3){
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarSupportedContent" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                        <!-- Menu Administrador -->
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
        <div class="content-center" id="container">
            <form method="POST" action="../processar/proc_edit_pagamento.php">
                <h1>Editar Pagamento</h1>
                <input type="hidden" name="id_pagamento" value="<?php echo $row_msg_cont['id_pagamento']; ?>">

                <div class="row">
                    <div class="col-md-3">
                        <label id="date-side" for="nome_completo">Passageiro</label>
                        <input type="text" name="nome_completo" id="nome_completo" class="form-control" value="<?php echo $row_msg_cont['nome_completo']; ?>" readonly>
                    </div>
                    <div class="col-md-1">
                        <label id="date-side" for="localizador">Localizador</label>
                        <input type="text" name="localizador" id="localizador" class="form-control" value="<?php echo $row_msg_cont['localizador']; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="origem">Origem</label>
                        <input type="text" name="origem" class="form-control" value="<?php echo $row_msg_cont['origem']; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="destino">Destino</label>
                        <input type="text" name="destino" class="form-control" value="<?php echo $row_msg_cont['destino']; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="protocolo_pagamento">Protocolo do Pagamento</label>
                        <input type="text" class="  form-control" name="protocolo_pagamento" id="protocolo_pagamento" pattern="[0-9]{7}-[0-9]{2}.[0-9]{4}.[8]{1}.[1-6]{2}.[0-6]{4}$" data-mask="0000000-00.0000.8.16.6000" data-mask-selectonfocus="true"value="<?php echo $row_msg_cont['protocolo_pagamento']; ?>" readonly>
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="comprovante">Comprovantes</label>
                        <input type="text" class="  form-control" name="comprovante" id="comprovante" value="<?php echo $row_msg_cont['comprovante']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label id="date-side" for="total_fatura">Valor Solicitado</label>
                        <input type="text" name="total_fatura" class="form-control" value="<?php echo $row_msg_cont['total_fatura']; ?>">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="valor_pago">Valor Autorizado</label>
                        <input type="text" name="valor_pago" class="form-control" value="<?php echo $row_msg_cont['valor_pago']; ?>">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="nota_fiscal">Nota Fiscal</label>
                        <input type="text" name="nota_fiscal" class="form-control" value="<?php echo $row_msg_cont['nota_fiscal']; ?>" >
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="doc_notafiscal">SEI Nota Fiscal</label>
                        <input type="text" name="doc_notafiscal" class="form-control" required="required" data-mask="0000000" data-mask-selectonfocus="true" value="<?php echo $row_msg_cont['doc_notafiscal']; ?>">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="fatura">Fatura</label>
                        <input type="text" class="form-control" name="fatura" value="<?php echo $row_msg_cont['fatura']; ?>">
                    </div>
                    <div class="col-md-2">
                        <label id="date-side" for="doc_fatura">SEI Fatura</label>
                        <input type="text" class="form-control" name="doc_fatura" required="required" data-mask="0000000" data-mask-selectonfocus="true" value="<?php echo $row_msg_cont['doc_fatura']; ?>">
                    </div>
                </div>
            <div class="row">
                <div class="col-md-3"> 
                    <label id="date-side" for="status_pagamento">Status</label>
                    <select class="custom-select" name="status_pagamento">
                        <option selected><?php echo $row_msg_cont['status_pagamento']; ?></option>
                        <?php 
                                if($row_msg_cont['status_pagamento'] == "ativo"){
                                    echo '<option name="status_pagamento" value="cancelado">cancelado</option>';
                                }
                                else{
                                    echo '<option name="status_pagamento" value="ativo">ativo</option>';
                                }
                            ?>
                    </select>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <input name="SendEditPagamento" type="submit" class="btn" value="Editar">
                    </div>
                </div>
            </div>
        </form>
    </div>
    </section>
    <footer>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- aparência e menu dropdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <!-- máscaras -->
    <script src="../js/jquery.mask.min.js"></script>

</body>

</html>