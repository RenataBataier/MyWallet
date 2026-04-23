<?php 

    session_start();    

    require_once 'funcoes.php';

    $fezLogin = $_SESSION['logado'] ?? null;
    $usuario = $_SESSION['usuario'] ?? null;
    $nome = $_SESSION['nome'] ?? null;

    if(!$fezLogin){
        header("Location: login.php");
        exit;
    }

    if(!isset($_SESSION['transacoes'])){
    $_SESSION['transacoes'] = [];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $descricao = $_POST['descricao'] ?? null;
    $valor = $_POST['valor'] ?? null;
    $tipo = $_POST['tipo'] ?? null;

        if($descricao && $valor && $tipo){
            $_SESSION['transacoes'][] = [
                'descricao' => $descricao,
                'valor' => (float)$valor,
                'tipo' => $tipo
            ];
        } 
        header("Location: index.php");
        exit;
    }

$saldo = calcularSaldo($_SESSION['transacoes']);

$totalReceitas = 0;
$totalDespesas = 0;

foreach($_SESSION['transacoes'] as $t){
    if($t['tipo'] === 'Receita'){
        $totalReceitas += $t['valor'];
    } else {
        $totalDespesas += $t['valor'];
    }
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


    <h4>Total Receitas</h4>
    <p><?= formatarReal($totalReceitas) ?></p>

    <h4>Total Despesas</h4>
    <p><?= formatarReal($totalDespesas) ?></p>

    <h4>Saldo Disponível</h4>
    <p><?= formatarReal($saldo) ?></p>

    <hr>

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