<?php
session_start();
include '../conexao.php';


    if(isset($_POST['btn_cancelar'])){

        $id_aditivo = filter_input(INPUT_POST, 'btn_cancelar', FILTER_SANITIZE_NUMBER_INT);

        $searchAd = "SELECT status_aditivo FROM tbl_aditivo WHERE id_aditivo = '$id_aditivo'";
        $search = $conn->prepare($searchAd);
        $search->execute();
        
        $row_ad = $search->fetch(PDO::FETCH_ASSOC);

        if($row_ad['status_aditivo'] == 'ativo'){
            $result_updateAditivo = "UPDATE tbl_aditivo SET status_aditivo = 'cancelado' WHERE id_aditivo = '$id_aditivo'";
        }
        else{
            $result_updateAditivo = "UPDATE tbl_aditivo SET status_aditivo = 'ativo' WHERE id_aditivo = '$id_aditivo'";
        }

        $resultado_updateAditivo = $conn->prepare($result_updateAditivo);

        if($resultado_updateAditivo->execute()){
            header("Location: ../confirmar/confirm_edit_aditivo.php?id_aditivo='.$id_aditivo.'");
        }
    }
    ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->

    <title>Consulta Aditivo</title>

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
            <h1>Consultar Aditivo</h1>
            <form method="POST" onsubmit="if(typeof fSub !== 'undefined') return false; fSub = true;">
                <div class="row">
                    <div class="col-md-2">
                        <label id="date-side">Pesquisar por:</label>
                        <select class="custom-select" name="tipo">
                            <option value="num_contrato" selected="selected">Número do Contrato</option>
                            <option value="num_aditivo" >Número do Aditivo</option>.
                        </select>
                    </div>
                    <div class="col-md-7">
                        <label id="date-side">Pesquisa</label>
                        <input type="text" name="valor" placeholder="Digite aqui o número">
                    </div>
                    <div class="col-md-3">
                        <input type="submit" class="btn" name="search" value="Pesquisar"></input> 
                    </div>
                </div>
            </form>
            <div class="row">
                <?php
                    if(isset($_POST['search'])){
                        $valor = $_POST['valor'];
                        if (strlen($valor) < 3) {
                                $result_aditivo = null;
                                echo "<script>alert('Digite um valor existente.');</script>";
                        }else{
                            if($_POST['tipo'] == "num_aditivo"){
                                $result_aditivo = 
                                    "SELECT * FROM tbl_contrato 
                                    INNER JOIN tbl_aditivo ON tbl_contrato.id_contrato = tbl_aditivo.id_contrato
                                    INNER JOIN tbl_item ON tbl_aditivo.id_item = tbl_item.id_item
                                    WHERE num_aditivo ILIKE '%$valor%'
                                    ORDER BY id_aditivo"
                                ;
                                    }
                            else if($_POST['tipo'] == "num_contrato"){
                                $result_aditivo = 
                                    "SELECT * FROM tbl_contrato 
                                    INNER JOIN tbl_aditivo ON tbl_contrato.id_contrato = tbl_aditivo.id_contrato
                                    INNER JOIN tbl_item ON tbl_aditivo.id_item = tbl_item.id_item
                                    WHERE num_contrato ILIKE '%$valor%'
                                    ORDER BY id_aditivo"
                                ;
                            } 
                        }
                                    
                        $resultado_aditivo = $conn->prepare($result_aditivo);
                        $resultado_aditivo->execute();

                        if ($resultado_aditivo->rowCount() > 0){

                            echo '
                            <div class="table-overflow">
                                <table class="table table-responsive">
                                <thead>     
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Número Aditivo</th>
                                            <th scope="col">Contrato</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Vigência</th>
                                            <th scope="col">Valor Aditivo</th>
                                            <th scope="col">Status</th>
                            ';
                            echo'                                        
                                        </tr>
                                    </thead>
                                ';
                                        
                            while($row_aditivo = $resultado_aditivo->fetch(PDO::FETCH_ASSOC))
                            {
                            echo '
                                <tbody>    
                                    <tr>
                                        <td><span id="id_aditivo">'.$row_aditivo['id_aditivo'].'</span></td>
                                        <td>'.$row_aditivo['num_aditivo'].'</td>
                                        <td>'.$row_aditivo['num_contrato'].'</td>
                                        <td>'.$row_aditivo['descricao'].'</td>
                                        <td>'.$row_aditivo['vigencia'].'</td>
                                        <td>'.$row_aditivo['valor_aditivo'].'</td>
                                        <th id="row_status" onclick="myFunction()" "scope="row"><span class="'.$row_aditivo['status_aditivo'].'">'.$row_aditivo['status_aditivo'].'</span></th>
                            ';
                            /*
                            if ($_SESSION['funcao'] == 1) {
                                echo '
                                    <td id="td-edicao"><button name="btn_cancelar" style="color: white" value="'.$row_aditivo['id_aditivo'].'">Cancelar</button></td>
                                ';
                            }
                            */
                            echo '
                                    <tr>
                            </tbody>';
                            }
                            echo '</table> </div>';                  
                        }
                    }
                ?>  
                 

            </div>
        </div>
    </section>
    <footer>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
        </div>
    </footer>
    <!-- menu dropdown -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    
    <!-- aparência e menu dropdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="..\js\funcoes.js"></script>
</body>

</html>