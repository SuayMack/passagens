<?php
session_start();

include_once("conexao.php");

$SendEditPassagem = filter_input(INPUT_POST, 'SendEditPassagem', FILTER_SANITIZE_STRING);
if($SendEditPassagem){
	$id_passagem = filter_input(INPUT_POST, 'id_passagem', FILTER_SANITIZE_NUMBER_INT);
	$origem = filter_input(INPUT_POST, 'origem', FILTER_SANITIZE_STRING);
	$destino = filter_input(INPUT_POST, 'destino', FILTER_SANITIZE_STRING);
	$companhia = filter_input(INPUT_POST, 'companhia', FILTER_SANITIZE_STRING);
	$localizador = filter_input(INPUT_POST, 'localizador', FILTER_SANITIZE_STRING);
	$tarifa_voucher = filter_input(INPUT_POST, 'tarifa_voucher', FILTER_SANITIZE_STRING);
	$taxas_voucher = filter_input(INPUT_POST, 'taxas_voucher', FILTER_SANITIZE_STRING);
	$classe = filter_input(INPUT_POST, 'classe', FILTER_SANITIZE_STRING);
	$autorizacao = filter_input(INPUT_POST, 'despacho', FILTER_SANITIZE_STRING);
	$bilhete = filter_input(INPUT_POST, 'bilhete', FILTER_SANITIZE_STRING);
	$multdestino = filter_input(INPUT_POST, 'multdestino', FILTER_SANITIZE_STRING);
	$destinoadicional = filter_input(INPUT_POST, 'destinoadicional', FILTER_SANITIZE_STRING);
	$obs_passagem = filter_input(INPUT_POST, 'obs_passagem', FILTER_SANITIZE_STRING);
	$status_passagem = filter_input(INPUT_POST, 'status_passagem', FILTER_SANITIZE_STRING);
	$data_ida = filter_input(INPUT_POST, 'data_ida', FILTER_SANITIZE_STRING);
	$data_retorno = filter_input(INPUT_POST, 'data_retorno', FILTER_SANITIZE_STRING);
	$grau = filter_input(INPUT_POST, 'grau', FILTER_SANITIZE_STRING);
	$userultimed = $_SESSION['id_usuario'];

	if($multdestino == "Não"){
		$destinoadicional = null;
	}
	
	$result_pessoa = "UPDATE tbl_passagem SET origem=:origem, destino=:destino, companhia=:companhia, localizador=:localizador, tarifa_voucher=:tarifa_voucher, taxas_voucher=:taxas_voucher, classe=:classe, despacho=:despacho, bilhete=:bilhete, multdestino=:multdestino, destinoadicional=:destinoadicional, obs_passagem=:obs_passagem, status_passagem=:status_passagem, data_ida=:data_ida, data_retorno=:data_retorno, grau=:grau, id_usuario_ultimed=$userultimed, data_ultimed=:data_ultimed
	WHERE id_passagem='$id_passagem'";

	$update_msg_cont = $conn->prepare($result_pessoa);
	$update_msg_cont->bindParam(':origem', $origem);
	$update_msg_cont->bindParam(':destino', $destino);
	$update_msg_cont->bindParam(':despacho', $autorizacao);
	$update_msg_cont->bindParam(':bilhete', $bilhete);
	$update_msg_cont->bindParam(':multdestino', $multdestino);
	$update_msg_cont->bindParam(':destinoadicional', $destinoadicional);
	$update_msg_cont->bindParam(':obs_passagem', $obs_passagem);
	$update_msg_cont->bindParam(':companhia', $companhia);
	$update_msg_cont->bindParam(':localizador', $localizador);
	$update_msg_cont->bindParam(':tarifa_voucher', $tarifa_voucher);
	$update_msg_cont->bindParam(':taxas_voucher', $taxas_voucher);
	$update_msg_cont->bindParam(':classe', $classe);
	$update_msg_cont->bindParam(':status_passagem', $status_passagem);
	$update_msg_cont->bindParam(':data_ida', $data_ida);
	$update_msg_cont->bindParam(':data_retorno', $data_retorno);
	$update_msg_cont->bindParam(':grau', $grau);
	$update_msg_cont->bindParam(':data_ultimed', date("Y-m-d"));
	

	if ($update_msg_cont->execute()) {
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Passagem editada com sucesso</div>";
		header("Location: ../confirmar/confirm_edit_passagem.php?id_passagem='.$id_passagem.'");
	} else {
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Passagem não foi editada com sucesso</div>";
		header("Location: ../editar/editar_passagem.php?id_passagem='.$id_passagem.'");
	}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'>Passagem não foi editada com sucesso</div>";
		header("Location: ../editar/editar_passagem.php");
		
	}
?>