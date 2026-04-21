<?php
session_start();

$fezLogin = $_SESSION['logado'] ?? null;
if($fezLogin){
    header("Location: index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === "POST"){

    $usuario = $_POST['usuario'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if(!is_null($usuario) && !is_null($senha)){
        if($usuario == "admin" && $senha == "1234"){
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

<form action="" method="post">
    Usuario: <input type="text" name="usuario">
    <br>
    Senha: <input type="text" name="senha">
    <br>
    <input type="submit" value="Fazer Login">
</form>