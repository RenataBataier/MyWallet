<?php
session_start();
require 'header.php';

$fezLogin = $_SESSION['logado'] ?? null;
if($fezLogin){
    header("Location: index.php");
}

$hashSenha = password_hash("1234", PASSWORD_DEFAULT);

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $usuario = $_POST['usuario'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if(!is_null($usuario) && !is_null($senha)){
        if($usuario == "admin" && password_verify($senha, $hashSenha)){
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit;
        }else{
            echo "<h4>Por favor, verifique se o login e senha estão corretos.</h4>";
        }
    }else {
        echo "<h4>Fazer Login</h4>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<form action="" method="post">
    UTILIZADOR: <br><input type="text" name="usuario">
    <br><br>
    PALAVRA-PASSE: <br><input type="password" name="senha">
    <br><br>
    <input type="submit" value="ENTRAR NO SISTEMA">
</form>

</body>
</html>