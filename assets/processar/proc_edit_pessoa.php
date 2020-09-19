<?php
session_start();
include_once '../conexao.php';

//Verificar se o usuário clicou no botão, clicou no botão acessa o IF e tenta cadastrar, caso contrario acessa o ELSE
$SendEditCont = filter_input(INPUT_POST, 'SendEditCont', FILTER_SANITIZE_STRING);
if($SendEditCont){
    //Receber os dados do formulário
    $id_pessoa = filter_input(INPUT_POST, 'id_pessoa', FILTER_SANITIZE_NUMBER_INT);
    $nome_completo = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING);
    $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_NUMBER_INT);
    $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING);
    $email_pessoa = filter_input(INPUT_POST, 'email_pessoa', FILTER_SANITIZE_EMAIL);
    $data_nascimento = filter_input(INPUT_POST, 'data_nascimento', FILTER_SANITIZE_STRING);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
    $rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING);
    $passaporte = filter_input(INPUT_POST, 'passaporte', FILTER_SANITIZE_STRING);
    $status_pessoa = filter_input(INPUT_POST, 'status_pessoa', FILTER_SANITIZE_STRING);
    $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
    
    //Inserir no BD
    $result_msg_cont = "UPDATE tbl_pessoa SET nome_completo=:nome_completo, matricula=:matricula, cargo=:cargo, email_pessoa=:email_pessoa, data_nascimento=:data_nascimento, cpf=:cpf, rg=:rg, passaporte=:passaporte, status_pessoa=:status_pessoa, celular=:celular WHERE id_pessoa='$id_pessoa'";
    
    $update_msg_cont = $conn->prepare($result_msg_cont);
    $update_msg_cont->bindParam(':nome_completo', $nome_completo);
    $update_msg_cont->bindParam(':matricula', $matricula);
    $update_msg_cont->bindParam(':cargo', $cargo);
    $update_msg_cont->bindParam(':email_pessoa', $email_pessoa);
    $update_msg_cont->bindParam(':celular', $celular);
    $update_msg_cont->bindParam(':data_nascimento', $data_nascimento);
    $update_msg_cont->bindParam(':cpf', $cpf);
    $update_msg_cont->bindParam(':rg', $rg);
    $update_msg_cont->bindParam(':passaporte', $passaporte);
    $update_msg_cont->bindParam(':status_pessoa', $status_pessoa);
    $update_msg_cont->bindParam(':celular', $celular);
    
    if($update_msg_cont->execute()){
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'><p style='color:green;'>Mensagem editada com sucesso</div>";
        header("Location: ../confirmar/confirm_edit_pessoa.php?id_pessoa=".$id_pessoa);
    }else{
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Mensagem não foi editada com sucesso</div>";
        header("Location: ../editar/editar_pessoa.php?id_pessoa=".$id_pessoa);
    }    
}else{
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'><p style='color:red;'>Mensagem não foi editada com sucesso</div>";
    header("Location: ../editar/editar_pessoa.php?id_pessoa=".$id_pessoa);
}
?>