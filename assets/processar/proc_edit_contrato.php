<?php
session_start();

include_once("conexao.php");

$SendEditContrato = filter_input(INPUT_POST, 'SendEditContrato', FILTER_SANITIZE_STRING);
if($SendEditContrato){
	$id_contrato = filter_input(INPUT_POST, 'id_contrato', FILTER_SANITIZE_NUMBER_INT);
	$num_contrato = filter_input(INPUT_POST, 'num_contrato', FILTER_SANITIZE_STRING);
	$contratada = filter_input(INPUT_POST, 'contratada', FILTER_SANITIZE_STRING);
	$cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_STRING);
	$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
	$vigencia = filter_input(INPUT_POST, 'vigencia', FILTER_SANITIZE_STRING);
	$email_contratada = filter_input(INPUT_POST, 'email_contratada', FILTER_SANITIZE_STRING);
	$status_contrato = filter_input(INPUT_POST, 'status_contrato', FILTER_SANITIZE_STRING);

	$result_contrato = "UPDATE tbl_contrato SET num_contrato=:num_contrato, contratada=:contratada, cnpj=:cnpj, telefone=:telefone, vigencia=:vigencia, email_contratada=:email_contratada, status_contrato=:status_contrato WHERE id_contrato='$id_contrato'";

	$update_msg_cont = $conn->prepare($result_contrato);
	$update_msg_cont->bindParam(':num_contrato', $num_contrato);
	$update_msg_cont->bindParam(':contratada', $contratada);
	$update_msg_cont->bindParam(':cnpj', $cnpj);
	$update_msg_cont->bindParam(':telefone', $telefone);
	$update_msg_cont->bindParam(':vigencia', $vigencia);
	$update_msg_cont->bindParam(':email_contratada', $email_contratada);
	$update_msg_cont->bindParam(':status_contrato', $status_contrato);
	

	if ($update_msg_cont->execute()) {
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Contrato editado com sucesso</div>";
		header("Location: ../confirmar/confirm_edit_contrato.php?id_contrato='.$id_contrato.'");
	} else {
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Erro na edição do contrato</div>";
		header("Location: ../editar/editar_contrato.php?id_contrato='.$id_contrato.'");
	}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'>Contrato não editado com sucesso</div>";
		header("Location: ../editar/editar_contrato.php");
		
	}
?>