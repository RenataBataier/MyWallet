<?php 

    session_start();    

    $fezLogin = $_SESSION['logado'] ?? null;
    $usuario = $_SESSION['usuario'] ?? null;
    $nome = $_SESSION['nome'] ?? null;

    if(!$fezLogin){
        header("Location: login.php");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyWallet</title>
</head>

<body>

    <h3>Olá <?= $usuario === 'admin' ? 'Admin' : $nome ?></h3>
    <a href="logout.php">Sair</a>


<h4>Nova Transação</h4>    
<form method="post">
    Descrição:
    <input type="text" name="descricao" placeholder="Ex: Salário, Aluguel...">
    <br><br>

    Valor:
    <input type="number" step="0.01" name="valor" placeholder="0,00">
    <br><br>

    Tipo:
    <select name="tipo">
        <option value="Receita">Receita</option>
        <option value="Despesa">Despesa</option>
    </select>
    <br><br>

    <input type="submit" value="Adicionar">
</form>    


</body>
</html>