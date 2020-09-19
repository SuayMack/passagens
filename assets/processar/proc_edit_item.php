<?php
session_start();

include_once("../conexao.php");

$SendEditItem = filter_input(INPUT_POST, 'SendEditItem', FILTER_SANITIZE_STRING);
if($SendEditItem){
	$id_item = filter_input(INPUT_POST, 'id_item', FILTER_SANITIZE_NUMBER_INT);
	$valor_contratado = filter_input(INPUT_POST, 'valor_contratado', FILTER_SANITIZE_STRING);
	$desconto_valor = filter_input(INPUT_POST, 'desconto_valor', FILTER_SANITIZE_STRING);
	$comissao_valor = filter_input(INPUT_POST, 'comissao_valor', FILTER_SANITIZE_STRING);
	$desconto_percentual = filter_input(INPUT_POST, 'desconto_percentual', FILTER_SANITIZE_STRING);
	$comissao_percentual = filter_input(INPUT_POST, 'comissao_percentual', FILTER_SANITIZE_STRING);
	$status_item = filter_input(INPUT_POST, 'status_item', FILTER_SANITIZE_STRING);

	$result_item = "UPDATE tbl_item SET valor_contratado=:valor_contratado, desconto_valor=:desconto_valor, comissao_valor=:comissao_valor, desconto_percentual=:desconto_percentual, comissao_percentual=:comissao_percentual, status_item=:status_item WHERE id_item='$id_item'";

    $update_msg_cont = $conn->prepare($result_item);
	$update_msg_cont->bindParam(':valor_contratado', $valor_contratado);
	$update_msg_cont->bindParam(':desconto_valor', $desconto_valor);
	$update_msg_cont->bindParam(':comissao_valor', $comissao_valor);
	$update_msg_cont->bindParam(':desconto_percentual', $desconto_percentual);
	$update_msg_cont->bindParam(':comissao_percentual', $comissao_percentual);
	$update_msg_cont->bindParam(':status_item', $status_item);
	

	if ($update_msg_cont->execute()) {
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Item editado com sucesso</div>";
		header("Location: ../confirmar/confirm_edit_item.php?id_item='.$id_item.'");
	} else {
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Erro na edição do item</div>";
		header("Location: ../editar/editar_item.php?id_item='.$id_item.'");
	}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'>Item não editado com sucesso</div>";
		header("Location: ../editar/editar_item.php");
		
	}
?>