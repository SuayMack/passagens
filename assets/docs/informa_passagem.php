<?php

session_start();

ob_start();

include_once '../conexao.php';

$idviagem = $_GET['id_viagem'];




$result_viagem =
    "SELECT evento, protocolo_compra FROM tbl_viagem WHERE id_viagem = $idviagem";

$resultado_viagem = $conn->prepare($result_viagem);
$resultado_viagem->execute();
$resultado_viagem->execute();
while ($row_viagem = $resultado_viagem->fetch(PDO::FETCH_ASSOC)) {
    $protocolocompra = $row_viagem['protocolo_compra'];
    $evento = $row_viagem['evento'];
}
if(isset($_POST['btnConcluir'])){
    header("Location: ../menu.php");
}
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
            <div style="text-align: center">
                <b>CERTIFICA COMPRA DE PASSAGEM</b><br><br><br>
            </div>
            <div style="text-align: justify; margin: 0 3rem 0 3rem">
              
            <br><br><b>I - </b>Informa-se que a(s) passagem(ns) autorizada(s) através do expediente <b>SEI nº <?=$protocolocompra;?></b>, cujo objeto trata da participação no evento: "<b><i><?=$evento;?></i></b>", já foi(ram) adquirida(s) e o(s) voucher(s) encaminhado(s) ao(s) respectivo(s) passageiro(s).<br>
            <b>II - </b><b>Registra-se que o(s) comprovante(s) de embarque deve(m) ser incluído(s) no presente protocolo pelo passageiro no prazo determinado pela Resolução nº 184/2017 <i>(5 dias úteis do retorno a sede)</i> e assinados digitalmente, conforme determina o §2º do artigo 7º da Instrução Normativa nº 05/2017.</b><br>
            <b>III - </b>Diante do exposto, encerra-se o presente processo nesta unidade.<br>
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
                            <b>II</b> - Conclua-se nesta Divisão.<br>
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
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                    <input type="submit" class="btn" id="btnConcluir" name="btnConcluir" value="Concluir">
                    </div>
                </div>
            </form>
        </div>

    </section>
    <footer>
        <div class=" footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
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