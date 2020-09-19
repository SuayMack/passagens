<?php
session_start();

include_once '../conexao.php';


$_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Aditivo cancelado com sucesso</div>";

$id_aditivo = filter_input(INPUT_GET, 'id_aditivo', FILTER_SANITIZE_NUMBER_INT);


if(isset($_POST['consulta'])){
    header("Location: ../consultar/consulta_aditivo.php");
}
if(isset($_POST['menu'])){
    header("Location: ../menu.php");
}    

if(isset($_POST['editar'])){

    $id_aditivo = filter_input(INPUT_POST, 'id_aditivo', FILTER_SANITIZE_NUMBER_INT);

        $result_updateAditivo = "UPDATE tbl_aditivo SET status_aditivo = 'ativo' WHERE id_aditivo = $id_aditivo";
        $resultado_updateAditivo = $conn->prepare($result_updateAditivo);
        $resultado_updateAditivo->execute();
        if($resultado_updateAditivo->execute()){
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Cancelamento revertido com sucesso</div>";

        }
    }


//SQL para selecionar o registro
$result_msg_cont = "SELECT * FROM tbl_aditivo
INNER JOIN tbl_contrato ON tbl_aditivo.id_contrato = tbl_contrato.id_contrato
WHERE id_aditivo = $id_aditivo";
                            
//Seleciona os registros
$resultado_msg_cont = $conn->prepare($result_msg_cont);
$resultado_msg_cont->execute();
$row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC); 

 //SQL para selecionar o registro
 $result_msg_cont2 = "SELECT descricao FROM tbl_item";
                            
 //Seleciona os registros
 $resultado_msg_cont2 = $conn->prepare($result_msg_cont2);
 $resultado_msg_cont2->execute();
 $row_msg_cont2 = $resultado_msg_cont2->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    
    <title>Editar Aditivo</title>

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



        <?php

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <section class="col-md-auto">   
            <div class="content-center" id="container">
                <form method="POST" onsubmit="if(typeof fSub !== 'undefined') return false; fSub = true;">
                    <h1>Cancelamento de Aditivo</h1>
                    <input type="hidden" name="id_aditivo" value="<?php echo $row_msg_cont['id_aditivo']; ?>">

                    <div class="row">
                        <!-- Select Num contrato -->
                        <div class="col-md-1">
                            <label id="date-side" for="id_contrato" >Contrato</label>   
                            <input type="text" class="form-control" name="id_contrato" id="id_contrato" value="<?php echo $row_msg_cont['num_contrato']; ?>" readonly>
                        </div>
                        <!-- Select Num Aditivo -->
                        <div class="col-md-1">
                            <label id="date-side" for="num_aditivo" >Aditivo</label>   
                            <input type="text" class="form-control" name="num_aditivo" id="num_aditivo" value="<?php if(isset($row_msg_cont['num_aditivo'])){ echo $row_msg_cont['num_aditivo']; } ?>" readonly>
                        </div>
                        <!-- Select Item -->
                        <div class="col-md-3">
                            <label id="date-side" for="descricao" >Item</label>   
                            <input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $row_msg_cont2['descricao']; ?>" readonly>
                        </div>
                        <!-- Select Valor do Aditado -->
                        <div class="col-md-2">
                            <label id="date-side" for="valor_aditivo">Valor do Aditado R$</label>   
                            <input type="text" class="form-control" name="valor_aditivo" id="valor_aditivo" value="<?php if(isset($row_msg_cont['valor_aditivo'])){ echo $row_msg_cont['valor_aditivo']; } ?>" readonly>
                        </div>
                        <!-- Select Vigência -->
                        <div class="col-md-2">
                            <label id="date-side" for="nova_vigencia">Vigência</label>
                            <input type="date" class="form-control" name="nova_vigencia" id="date-side" value="<?php if(isset($row_msg_cont['nova_vigencia'])){ echo $row_msg_cont['nova_vigencia']; } ?>" readonly>
                        </div>
                        <div class="col-md-2">
                            <label id="date-side" for="status_aditivo">Situação</label>
                            <input type="text" class="form-control" name="status_aditivo" id="date-side" value="<?php if(isset($row_msg_cont['status_aditivo'])){ echo $row_msg_cont['status_aditivo']; } ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="submit" class="btn" name="editar" value="Reverter Cancelamento">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn" name="consulta" value="Consultar Aditivos">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn" name="menu" value="Menu">
                        </div>
                    </div>
                </form>
            </div>
        </section>
    <footer>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
        </div>
    </footer>

    <!-- aparência e menu dropdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

</body>

</html>