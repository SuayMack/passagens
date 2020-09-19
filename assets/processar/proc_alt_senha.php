<?php
session_start();

include_once '../conexao.php';

$SendAltSenha = filter_input(INPUT_POST, 'SendAltSenha', FILTER_SANITIZE_STRING);

if($SendAltSenha){
    $id_user = $_SESSION['id_usuario'];
    $nova_senha = filter_input(INPUT_POST, 'nova_senha', FILTER_SANITIZE_STRING);
    $conf_senha = filter_input(INPUT_POST, 'conf_senha', FILTER_SANITIZE_STRING);

    $password = password_hash($nova_senha, PASSWORD_DEFAULT);

    $alt_senha = "UPDATE tbl_usuario SET senha = '$password'  WHERE id_usuario = '$id_user'";

    $altera_senha = $conn->prepare($alt_senha);

    if($altera_senha->execute()){
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert' style='text-align: center; font-weight: 800'>Senha alterada com sucesso</div>";
        header("Location: ../menu.php");
    }else{
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'>Senha não foi alterada</div>";
        header("Location: ../menu.php");
    }    
}else{
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert' style='text-align: center; font-weight: 800'>As senhas não coincidem</div>";
        header("Location: ../menu.php");
    }
?>