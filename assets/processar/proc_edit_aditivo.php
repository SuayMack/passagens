<?php
session_start();

include_once("conexao.php");

//SQL para selecionar o registro
$resultvaloratual = "SELECT valor_contratado FROM tbl_item WHERE id_aditivo = $id_aditivo";
                                    
//Seleciona os registros
$resultvaloratual = $conn->prepare($resultvaloratual);
$resultvaloratual->execute();
$row_valoratual = $resultvaloratual->fetch(PDO::FETCH_ASSOC);

$SendEditAditivo = filter_input(INPUT_POST, 'SendEditAditivo', FILTER_SANITIZE_STRING);
if($SendEditAditivo){
	$id_aditivo = filter_input(INPUT_POST, 'id_aditivo', FILTER_SANITIZE_NUMBER_INT);
    $id_contrato = filter_input(INPUT_POST, 'id_contrato', FILTER_SANITIZE_NUMBER_INT);
    $num_aditivo = filter_input(INPUT_POST, 'num_aditivo', FILTER_SANITIZE_STRING);
	$id_item = filter_input(INPUT_POST, 'id_item', FILTER_SANITIZE_NUMBER_INT);
	$valor_aditivo = filter_input(INPUT_POST, 'valor_aditivo', FILTER_SANITIZE_STRING);
	$nova_vigencia = filter_input(INPUT_POST, 'nova_vigencia', FILTER_SANITIZE_STRING);
	$status_aditivo = filter_input(INPUT_POST, 'status_aditivo', FILTER_SANITIZE_STRING);
	

	$result_item = "UPDATE tbl_aditivo SET id_contrato=:id_contrato, num_aditivo=:num_aditivo, id_item=:id_item, valor_aditivo=:valor_aditivo, nova_vigencia=:nova_vigencia, status_aditivo=:status_aditivo WHERE id_aditivo='$id_aditivo'";

    $update_msg_cont = $conn->prepare($result_item);
    $update_msg_cont->bindParam(':id_contrato', $id_contrato);
    $update_msg_cont->bindParam(':num_aditivo', $num_aditivo);
	$update_msg_cont->bindParam(':id_item', $id_item);
	$update_msg_cont->bindParam(':valor_aditivo', $valor_aditivo);
	$update_msg_cont->bindParam(':nova_vigencia', $nova_vigencia);
	$update_msg_cont->bindParam(':desconto_percentual', $desconto_percentual);
	$update_msg_cont->bindParam(':comissao_percentual', $comissao_percentual);
	$update_msg_cont->bindParam(':status_aditivo', $status_aditivo);
	

    
    $valoratual = $row_valoratual;
    $novovalor = $valoratual + $valor_aditivo;


    $result_updateItem = "UPDATE tbl_item SET valor_contratado = '$novovalor' WHERE id_item = '$id_item'";
    $resultado_updateItem = $conn->prepare($result_updateItem);
    $resultado_updateItem->execute();

    $result_updateContrato = "UPDATE tbl_contrato SET vigencia = '$nova_vigencia' WHERE id_contrato = '$id_contrato'";
    $resultado_updateContrato = $conn->prepare($result_updateContrato);
    $resultado_updateContrato->execute();
	

	if ($update_msg_cont->execute()) {
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Aditivo editado com sucesso</div>";
		header("Location: ../confirmar/confirm_edit_aditivo.php?id_aditivo='.$id_aditivo.'");
	} else {
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Erro na edição do aditivo</div>";
		header("Location: ../editar/editar_aditivo.php?id_aditivo='.$id_aditivo.'");
	}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'>Aditivo não editado com sucesso</div>";
		header("Location: ../editar/editar_aditivo.php");
		
	}
?>