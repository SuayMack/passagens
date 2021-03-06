<?php
	
	session_start();

    ob_start();
    
    include_once '../conexao.php';
	
	$btnCadContrato = filter_input(INPUT_POST, 'btnCadContrato', FILTER_SANITIZE_STRING);
	
	if($btnCadContrato){	
    
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        $result_updateContrato = "UPDATE tbl_contrato SET status_contrato = 'vencido' WHERE status_contrato LIKE 'vigente'";
        $resultado_updateContrato = $conn->prepare($result_updateContrato);
        $resultado_updateContrato->execute();

        $result_updateItem = "UPDATE tbl_item SET status_item = 'inativo' WHERE status_item LIKE 'ativo'";
        $resultado_updateItem = $conn->prepare($result_updateItem);
        $resultado_updateItem->execute();


		$result_contrato = "INSERT INTO tbl_contrato (num_contrato, contratada, cnpj, telefone, vigencia, email_contratada, status_contrato, data_inicio, representante_legal, rg_representante, cpf_representante, data_assinatura, protocolo_contrato, vig_meses, pregao, diario_justica, data_publicacao)  VALUES (
		'" .$dados['num_contrato']. "',
		'" .$dados['contratada']. "',
		'" .$dados['cnpj']. "',
		'" .$dados['telefone']. "',
		'" .$dados['vigencia']. "',
        '" .$dados['email_contratada']. "',
        '" .$dados['status_contrato']. "',
        '" .$dados['data_inicio']. "',
        '" .$dados['representante_legal']. "',
        '" .$dados['rg_representante']. "',
        '" .$dados['cpf_representante']. "',
        '" .$dados['data_assinatura']. "',
        '" .$dados['protocolo_contrato']. "',
        '" .$dados['vig_meses']. "',
        '" .$dados['pregao']. "',
        '" .$dados['diario_justica']. "',
        '" .$dados['data_publicacao']. "'
        )";       

        $resultado_contrato = $conn->prepare($result_contrato);
        $resultado_contrato->execute();
        
        header("Location: cadastrar_item.php");
		
	}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
    
    <title>Cadastro de Contrato</title>

    <link rel="shortcut icon" href="assets/img/ico.png" type="image/png">
    
    <!-- Estilos / Formatação -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
                if(isset($_SESSION['msg'])){
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
                <h1>Contrato</h1>
                    <fieldset>
                        <legend>Dados do Contrato</legend>
                        <div class="fieldset">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label id="date-side" for="num_contrato">Número do Contrato</label>
                                    <input type="text" class="form-control" name="num_contrato" id="num_contrato" required="required">
                                </div>
                                <div class="col-sm-3">
                                    <label id="date-side" for="protocolo_contrato">Protocolo</label>
                                    <input type="text" class="form-control" name="protocolo_contrato" id="protocolo_contrato" required="required" maxlength="25"
                        pattern="[0-9]{7}-[0-9]{2}.[0-9]{4}.[8]{1}.[1-6]{2}.[0-6]{4}$"
                        placeholder="0000000-00.0000.8.16.6000" data-mask="0000000-00.0000.8.16.6000"
                        data-mask-selectonfocus="true">
                                </div>
                                <div class="col-sm-2">
                                    <label id="date-side" for="pregao">Pregão Eletrônico</label>
                                    <input type="text" class="form-control" name="pregao" id="pregao" maxlength="8" required="required" placeholder="000/2000">
                                </div>
                                <div class="col-sm-2">
                                    <label id="date-side" for="diario_justica">Diário da Justiça</label>
                                    <input type="text" class="form-control" name="diario_justica" id="diario_justica" maxlength="5" required="required" placeholder="0000">
                                </div>
                                <div class="col-sm-3">
                                    <label id="date-side" for="data_publicacao">Data de Publicação</label>
                                    <input type="date" class="form-control" name="data_publicacao" id="data_publicacao" required="required">
                                </div>
                                <div class="col-sm-3">
                                    <label id="date-side" for="vig_meses">Vigência em Meses</label>
                                    <input type="number" class="form-control" name="vig_meses" id="vig_meses" required="required" placeholder="12">
                                </div>
                                <div class="col-sm-3">
                                    <label id="date-side" for="data_assinatura">Data de Assinatura</label>
                                    <input type="date" class="form-control" name="data_assinatura" id="data_assinatura" required="required">
                                </div>
                                <div class="col-sm-3">
                                    <label id="date-side" for="data_inicio">Data de Início</label>
                                    <input type="date" class="form-control" name="data_inicio" id="data_inicio" required="required">
                                </div>     
                                <div class="col-sm-3">
                                    <label id="date-side" for="vigencia">Vigência Atual</label>
                                    <input type="date" class="form-control" name="vigencia" id="date-side" required="required">
                                </div>
                            </div> 
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Dados do Contratada</legend>
                        <div class="fieldset">
                            <div class="row">
                                <div class="col-md-4">
                                    <label id="date-side" for="contratada">Razão Social</label>
                                    <input type="text" class="form-control" name="contratada" id="contratada" required="required">
                                </div>
    
                                <div class="col-md-3">
                                    <label id="date-side" for="cnpj">CNPJ</label>
                                    <input type="text" class="form-control" name="cnpj" id="cnpj" required="required" data-mask="00.000.000/0000-00" data-mask-selectonfocus="true">
                                </div>
                                <div class="col-md-3">
                                    <label id="date-side" for="email_contratada">E-mail</label>
                                    <input type="email" class="form-control" name="email_contratada" id="email_contratada" required="required">
                                </div>
                                <div class="col-md-2">
                                    <label id="date-side" for="telefone">Telefone</label>
                                    <input type="text" class="telefone form-control" name="telefone" id="telefone" data-mask="(00) 0000-0000" data-mask-selectonfocus="true"/>
                                </div>

                                <div class="col-md-4">
                                    <label id="date-side" for="representante_legal">Representante Legal</label>
                                    <input type="text" class="form-control" name="representante_legal" id="representante_legal" required="required">
                                </div>
                                <div class="col-md-4 ">
                                    <label id="date-side" for="cpf_representante">C.P.F.</label>
                                    <input type="text" class="cpf form-control" name="cpf_representante" id="cpf_representante" required="required"
                                        data-mask="000.000.000-00" data-mask-selectonfocus="true" />
                                </div>
                                <div class="col-md-4">
                                    <label id="date-side" for="rg_representante">R.G.</label>
                                    <input type="text" class="form-control" name="rg_representante" id="rg_representante" maxlength="14">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                    <div class="col-md-6">
                        <input type="submit" class="btn" value="Salvar" name="btnCadContrato"></input>     
                    </div>
                    <div class="col-md-6">
                        <a href="../menu.php">
                        <button type="button" class='btn'>Cancelar</button>
                        </a>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="status_contrato" id="status_contrato" value="vigente">
            <!-- Fim Campos -->    
            </form>                                          
        </div>
    </section>
    <footer>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens  
        </div>
    </footer>

        	<!-- menu dropdown -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            
            <!-- aparência e menu dropdown -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
            <!-- máscaras -->
    <script src="../js/jquery.mask.min.js"></script>
    </body>

</html>