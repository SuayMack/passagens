<?php
session_start();
include_once '../conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendEditViagem = filter_input(INPUT_POST, 'SendEditViagem', FILTER_SANITIZE_STRING);
if($SendEditViagem){
    //Receber os dados do formulário
    $id_viagem = filter_input(INPUT_POST, 'id_viagem', FILTER_SANITIZE_NUMBER_INT);
    $protocolo_compra = filter_input(INPUT_POST, 'protocolo_compra', FILTER_SANITIZE_STRING);
    $requisitante = filter_input(INPUT_POST, 'requisitante', FILTER_SANITIZE_STRING);
    $evento = filter_input(INPUT_POST, 'evento', FILTER_SANITIZE_STRING);
    $observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_STRING);
    $status_viagem = filter_input(INPUT_POST, 'status_viagem', FILTER_SANITIZE_STRING);
    
    //Inserir no BD
    $result_msg_cont = "UPDATE tbl_viagem SET protocolo_compra=:protocolo_compra, requisitante=:requisitante, evento=:evento, observacoes=:observacoes, status_viagem=:status_viagem WHERE id_viagem='$id_viagem'";
    
    $update_msg_cont = $conn->prepare($result_msg_cont);
    $update_msg_cont->bindParam(':protocolo_compra', $protocolo_compra);
    $update_msg_cont->bindParam(':requisitante', $requisitante);
    $update_msg_cont->bindParam(':evento', $evento);
    $update_msg_cont->bindParam(':observacoes', $observacoes);
    $update_msg_cont->bindParam(':status_viagem', $status_viagem);
    
    if($update_msg_cont->execute()){
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'><p style='color:green;'>Viagem editada com sucesso</div>";
        header("Location: ../confirmar/confirm_edit_viagem.php?id_viagem=".$id_viagem);
    }else{
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Viagem não foi editada com sucesso</div>";
        header("Location: ../editar/editar_viagem.php?id_viagem=".$id_viagem);
    }    
}else{
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Vaigem não foi editada com sucesso</div>";
    header("Location: ../editar/editar_viagem.php?id_viagem=".$id_viagem);
}
?>