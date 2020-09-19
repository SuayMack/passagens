<?php
session_start();

include_once("conexao.php");

$SendEditPagamento = filter_input(INPUT_POST, 'SendEditPagamento', FILTER_SANITIZE_STRING);
if($SendEditPagamento){
	$id_pagamento = filter_input(INPUT_POST, 'id_pagamento', FILTER_SANITIZE_NUMBER_INT);
    $comprovante = filter_input(INPUT_POST, 'comprovante', FILTER_SANITIZE_NUMBER_INT);
	$total_fatura = filter_input(INPUT_POST, 'total_fatura', FILTER_SANITIZE_STRING);
	$valor_pago = filter_input(INPUT_POST, 'valor_pago', FILTER_SANITIZE_STRING);
	$nota_fiscal = filter_input(INPUT_POST, 'nota_fiscal', FILTER_SANITIZE_STRING);
	$doc_notafiscal = filter_input(INPUT_POST, 'doc_notafiscal', FILTER_SANITIZE_NUMBER_INT);
	$fatura = filter_input(INPUT_POST, 'fatura', FILTER_SANITIZE_STRING);
	$doc_fatura = filter_input(INPUT_POST, 'doc_fatura', FILTER_SANITIZE_NUMBER_INT);
	$status_pagamento = filter_input(INPUT_POST, 'status_pagamento', FILTER_SANITIZE_STRING);

	$result_pagamento = "UPDATE tbl_pagamento SET comprovante=:comprovante, total_fatura=:total_fatura, valor_pago=:valor_pago, nota_fiscal=:nota_fiscal, doc_notafiscal=:doc_notafiscal, fatura=:fatura, doc_fatura=:doc_fatura, status_pagamento=:status_pagamento WHERE id_pagamento='$id_pagamento'";

    $update_msg_cont = $conn->prepare($result_pagamento);
    $update_msg_cont->bindParam(':comprovante', $comprovante);
	$update_msg_cont->bindParam(':total_fatura', $total_fatura);
	$update_msg_cont->bindParam(':valor_pago', $valor_pago);
	$update_msg_cont->bindParam(':nota_fiscal', $nota_fiscal);
	$update_msg_cont->bindParam(':doc_notafiscal', $doc_notafiscal);
	$update_msg_cont->bindParam(':fatura', $fatura);
	$update_msg_cont->bindParam(':doc_fatura', $doc_fatura);
	$update_msg_cont->bindParam(':status_pagamento', $status_pagamento);
	

	if ($update_msg_cont->execute()) {
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Item editado com sucesso</div>";
		header("Location: ../confirmar/confirm_edit_pagamento.php?id_pagamento='.$id_pagamento.'");
	} else {
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Erro na edição do item</div>";
		header("Location: ../editar/editar_pagamento.php?id_pagamento='.$id_pagamento.'");
	}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'>Item não editado com sucesso</div>";
		header("Location: ../editar/editar_pagamento.php");
		
	}
?>