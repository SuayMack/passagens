<?php
session_start();

include_once '../conexao.php';

$id_passagem = filter_input(INPUT_GET, 'id_passagem', FILTER_SANITIZE_NUMBER_INT);

	//SQL para selecionar o registro
$result_msg_cont = "SELECT * FROM tbl_passagem
					LEFT JOIN tbl_pessoa
					ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
					LEFT JOIN tbl_item
					ON tbl_passagem.id_item = tbl_item.id_item
					LEFT JOIN tbl_viagem
					ON tbl_passagem.id_viagem = tbl_viagem.id_viagem
					LEFT JOIN tbl_contrato
					ON tbl_passagem.id_contrato = tbl_contrato.id_contrato
					WHERE id_passagem = $id_passagem";

	//Seleciona os registros
$resultado_msg_cont = $conn->prepare($result_msg_cont);
$resultado_msg_cont->execute();
$row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC); 

if(isset($_POST['editar'])){
    header("Location: ../editar/editar_passagem.php?id_passagem=".$id_passagem."");
}
if(isset($_POST['consulta'])){
    header("Location: ../consultar/consulta_passagem.php");
}
if(isset($_POST['menu'])){
    header("Location: ../menu.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->
	<title>Passagem</title>

	<link rel="shortcut icon" href="../img/icon.png" type="image/png">

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
			<form method="POST" onsubmit="if(typeof fSub !== 'undefined') return false; fSub = true;">
				<h1>Passagem</h1>
				
				<input type="hidden" name="id_passagem" value="<?php echo $row_msg_cont['id_passagem']; ?>">	
				
				<div class="row">
					<!-- Select Viagem -->
					<div class="col-md-3">
						<label id="date-side" for="protocolo_compra" >Protocolo da Viagem</label>   
						<input type="text" class="form-control" name="protocolo_compra" id="protocolo_compra" value="<?php echo $row_msg_cont['protocolo_compra']; ?>" readonly>
					</div>
					<!-- Select Passageiro -->
					<div class="col-md-5">
						<label id="date-side" for="nome_completo">Passageiro</label>   
						<input type="text" class="form-control" name="nome_completo" id="nome_completo" value="<?php echo $row_msg_cont['nome_completo']; ?>" readonly>
					</div>
					<div class="col-md-2">
							<label id="date-side" for="despacho">Autorização</label>
							<input type="number" class="form-control" name="despacho" id="despacho" data-mask="0000000" data-mask-selectonfocus="true" value="<?php echo $row_msg_cont['despacho']; ?>" readonly>
						</div>
						<!-- doc sei voucher -->
						<div class="col-md-2">
							<label id="date-side" for="bilhete">Bilhete (Voucher)</label>
							<input type="number" class="form-control" name="bilhete" id="bilhete" placeholder="Documento SEI" data-mask="0000000" data-mask-selectonfocus="true" value="<?php echo $row_msg_cont['bilhete']; ?>" readonly>
						</div>
				</div>
				<div class="row">
					<!-- Início Select Grau -->
					<div class="col-md-1">
						<label id="date-side" for="grau">Grau</label>
						<input type="text" class="form-control" name="grau" id="grau" value="<?php echo $row_msg_cont['grau']; ?>" readonly>
					</div>
					<!-- Select Contrato -->
					<div class="col-md-2">
						<label id="date-side" for="num_contrato">Contrato</label>   
						<input type="text" class="form-control" name="num_contrato" id="num_contrato" value="<?php echo $row_msg_cont['num_contrato']; ?>" readonly>
					</div>
					<!-- Select Item -->
					<div class="col-md-3">
						<label id="date-side" for="descricao">Tipo</label>   
						<input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $row_msg_cont['descricao']; ?>" readonly>
					</div>
					<div class="col-md-2">
						<label id="date-side" for="classe">Classe</label>
						<input type="text" class="form-control" name="classe" id="classe" value="<?php echo $row_msg_cont['classe']; ?>" readonly>
					</div>
					<div class="col-md-2">
							<label id="date-side" for="multdestino">Multi Destinos</label>
							<input type="text" class="form-control" name="multdestino" id="multdestino" value="<?php echo $row_msg_cont['multdestino']; ?>" readonly>  
						</div>
						<div class="col-md-2">
							<label id="date-side" for="destinoadicional">Trecho Completo</label>
							<input class="form-control" type="text" name="destinoadicional" value="<?php echo $row_msg_cont['destinoadicional']; ?>" readonly>
						</div>
				</div>
				<div class="row">
					<!-- Select Origem -->
					<div class="col-md-3">
						<label id="date-side" for="origem">Origem</label>
						<input class="form-control" type="text" name="origem" value="<?php echo $row_msg_cont['origem']; ?>" readonly>
					</div>
					<div class="col-md-3">
						<label id="date-side" for="data_ida">Data de Ida</label>
						<input type="date" class="form-control" name="data_ida" id="data_ida" required="required" value="<?php echo $row_msg_cont['data_ida']; ?>" readonly>
					</div>
					<div class="col-md-3">
						<label id="date-side" for="destino">Destino</label>
						<input class="form-control" type="text" name="destino" value="<?php echo $row_msg_cont['destino']; ?>" readonly>
					</div>
					<div class="col-md-3">
						<label id="date-side" for="data_retorno">Data de Retorno</label>
						<input type="date" class="form-control" name="data_retorno" id="data_retorno" value="<?php echo $row_msg_cont['data_retorno']; ?>" readonly>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 ">
						<label id="date-side" for="tarifa_voucher">Passagem / Seguro R$</label>
						<input type="number" min="0.01" step="0.01" class="form-control" name="tarifa_voucher" id="tarifa_voucher" value="<?php echo $row_msg_cont['tarifa_voucher']; ?>" readonly>
					</div>
					<div class="col-md-2 ">
						<label id="date-side" for="taxas_voucher">Taxas R$</label>
						<input type="number" class="form-control" name="taxas_voucher" id="taxas_voucher" value="<?php echo $row_msg_cont['taxas_voucher']; ?>" readonly>
					</div>
					<div class="col-md-3">
						<label id="date-side" for="companhia">Companhia / Seguradora</label>
						<input type="text" class="form-control" name="companhia" id="companhia" value="<?php echo $row_msg_cont['companhia']; ?>" readonly>
					</div>
					<div class="col-md-3">
						<label id="date-side" for="localizador">Localizador / Apólice</label>
						<input type="text" class="form-control" name="localizador" id="localizador" value="<?php echo $row_msg_cont['localizador']; ?>" readonly>
					</div>
					<div class="col-md-2"> 
						<label id="date-side" for="grau">Situação</label>
						<input type="text" class="form-control" name="status_passagem" id="status_passagem" value="<?php echo $row_msg_cont['status_passagem']; ?>" readonly>
					</div>
				</div>
				<div class="row">
						<div class="col-md-12">
							<label id="date-side" for="obs_passagem">Observações</label>
							<input type="text" class="form-control" id="obs_passagem" name="obs_passagem" value="<?php echo $row_msg_cont['obs_passagem']; ?>" readonly>
						</div>
				</div>
				<div class="row">
                        <div class="col-md-4">
                            <input type="submit" class="btn" name="editar" value="Editar">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn" name="consulta" value="Consultas">
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
	
	<!-- máscaras -->
    <script src="assets/js/jquery.mask.min.js"></script>
</body>
</html>