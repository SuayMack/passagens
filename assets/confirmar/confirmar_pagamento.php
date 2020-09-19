<?php
session_start();

ob_start();

include_once '../conexao.php';

$btnValidaPagamento = filter_input(INPUT_POST, 'btnValidaPagamento', FILTER_SANITIZE_STRING);

$idpassagem = $_GET['id_passagem'];
$protocolo = $_GET['protocolo_pagamento'];
$comprovante = $_GET['comprovante'];
$totalfatura = $_GET['total_fatura'];
$notafiscal = $_GET['nota_fiscal'];
$seinotafiscal = $_GET['doc_notafiscal'];
$seifatura = $_GET['doc_fatura'];
$fatura = $_GET['fatura'];



if ($btnValidaPagamento) {

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $result_pagamento = "INSERT INTO tbl_pagamento (id_passagem, protocolo_pagamento, comprovante, nota_fiscal, doc_notafiscal, fatura, doc_fatura, total_fatura, obs_pagamento, data_notificacao, glosa, status_pagamento, valor_pago, id_usuario)
        VALUES (
        '" . $idpassagem . "',
        '" . $protocolo . "',
        '" . $comprovante . "',
		'" . $notafiscal . "',
        '" . $seinotafiscal . "',
		'" . $fatura . "',
        '" . $seifatura . "',
        '" . $totalfatura . "',
        '" . $dados['obs_pagamento'] . "',
        '" . $dados['data_notificacao'] . "',
        '" . $dados['glosa'] . "',
        '" . $dados['status_pagamento'] . "',
        '" . $dados['valor_pago'] . "',
        '" . $_SESSION['id_usuario'] . "'

        )";

    $resultado_pagamento = $conn->prepare($result_pagamento);
    $resultado_pagamento->execute();

    $result_update = "UPDATE tbl_passagem SET pagamento = true WHERE id_passagem = '$idpassagem'";
    $resultado_update = $conn->prepare($result_update);
    $resultado_update->execute();

    header("Location: ../cadastrar/cadastrar_pagamento.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- telas responsivas -->

    <title>Confirmar Pagamento</title>

    <link rel="shortcut icon" href="../img/icon.png" type="image/png">
<!-- Estilos / Formatação -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
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
                <h1>Validar Pagamento</h1>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $result_passagem =
                            "SELECT * FROM tbl_passagem
                                    LEFT JOIN tbl_pessoa
                                    ON tbl_passagem.id_pessoa = tbl_pessoa.id_pessoa
                                    LEFT JOIN tbl_item
                                    ON tbl_passagem.id_item = tbl_item.id_item
                                    WHERE tbl_passagem.id_passagem = $idpassagem";

                        $resultado_passagem = $conn->prepare($result_passagem);
                        $resultado_passagem->execute();
                        echo '
                            <input type="hidden" id="id_passagem" name="id_passagem" value="'.$idpassagem.'">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Passageiro</th>
                                            <th scope="col">Localizador</th>
                                            <th scope="col">Tarifa R$</th>
                                            <th scope="col">Taxa R$</th>
                                            <th scope="col">Desconto R$</th>
                                            <th scope="col">Obs.</th>
                                        </tr>
                                    </thead>'
                                        
                        ;
                                    

                        while ($row_passagem = $resultado_passagem->fetch(PDO::FETCH_ASSOC)) {
                            $tarifa = $row_passagem['tarifa_voucher'];
                            $taxas = $row_passagem['taxas_voucher'];
                            $devalor = $row_passagem['desconto_valor'];
                            $comvalor = $row_passagem['comissao_valor'];
                            $desper = $row_passagem['desconto_percentual'];
                            $comper = $row_passagem['comissao_percentual'];
                            $obspass = $row_passagem['obs_passagem'];


                            echo '
                                    <tbody>
                                        <tr>
                                            <td>' . $idpassagem . '</td>
                                            <td>' . $row_passagem['nome_completo'] . '</td>
                                            <td>' . $row_passagem['localizador'] . '</td>
                                            <td>' . number_format($tarifa, 2,",",".") . '</td>
                                            <td>' . number_format($taxas, 2,",",".") . '</td>
                                            <td>' . number_format($devalor, 2,",",".") . '</td>
                                            <td>' . $obspass . '</td>
                                            
                                        </tr>                                       
                                    </tbody>
                                </table>';
                        }
                        //valor Apurado  
                        $trftx = $tarifa + $taxas;
                        
                        $comissaperc = (($trftx  * $comper) / 100) + $trftx;
                        $descperc = $comissaperc - (($comissaperc *  $desper) / 100);
                        $comisvalor = $descperc + $comvalor;
                        $vlrapurado = $comisvalor - $devalor;

                        //valor Glosa

                        $vrlglosa = $totalfatura - $vlrapurado;
                        if ($vrlglosa < 0.05) {
                            $vrlglosa = 0;
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label id="date-side" for="valor_fatura">Valor Solicitado R$</label>
                        <input type="text" class="  form-control" name="valor_pagar" id="valor_pagar"
                            value="<?= number_format($totalfatura, 2,",","."); ?> " readonly>
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="valor_apurado">Valor Apurado R$</label>
                        <input type="text" class="  form-control" name="valor_apurado" id="valor_apurado"
                            value="<?= number_format($vlrapurado, 2,",","."); ?> " readonly>

                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="glosa">Glosa R$</label>
                        <input type="text" class="  form-control" name="glosa" id="glosa"
                            value="<?= number_format($vrlglosa, 2,",","."); ?> " readonly>
                    </div>
                    <div class="col-md-3">
                        <label id="date-side" for="valor_pago">Valor Autorizado R$</label>
                        <input type="number" min="0.01" step="0.01" class="form-control" name="valor_pago" id="valor_pago"
                            required="required">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label id="date-side" for="data_notificacao">Notificação</label>
                        <input type="date" class="form-control" name="data_notificacao" id="data_notificacao">
                    </div>
                    <div class="col-md-9">
                    <label id="date-side" for="obs_pagamento">Observações</label>
                        <textarea class="form-control" id="obs_pagamento" name="obs_pagamento" rows="1"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" class="btn" id="btnValidaPagamento" value="Salvar"
                            name="btnValidaPagamento"></input>
                    </div>
                    <div class="col-md-6">
                        <input type="submit" class="btn" id="btnCancela" value="Cancelar" onclick="javascript: location.href='../menu.php';"></input>
                    </div>

                </div>
                <!-- Fim Campos -->
                <input type="hidden" name="status_pagamento" id="status_pagamento" value="ativo">
            </form>
        </div>
    </section>
    <footer>
        <br><br>
        <div class="footer">©️ Tribunal de Justiça do Estado do Paraná - Sistema de Controle de Passagens
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