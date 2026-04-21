<?php 

    session_start();    

    $fezLogin = $_SESSION['logado'] ?? null;
    $usuario = $_SESSION['usuario'] ?? null;
    $nome = $_SESSION['nome'] ?? null;

    if(!$fezLogin){
        header("Location: login.php");
    }
    
?>


<h3>Olá <?= $usuario === 'admin' ? 'Admin' : $nome ?></h3>
<a href="logout.php">Sair</a>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyWallet</title>
</head>
<body>
    
</body>
</html>