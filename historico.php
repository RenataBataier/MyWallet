<?php
    session_start();
    require 'header.php';

    require_once 'funcoes.php';

    $fezLogin = $_SESSION['logado'] ?? null;

    if(!$fezLogin){
        header("Location: login.php");
        exit;
    }

    if(!isset($_SESSION['transacoes'])){
        $_SESSION['transacoes'] = [];
    }

    // excluir uma transação
    if(isset($_GET['excluir'])){
        $indice = $_GET['excluir'];

        if(isset($_SESSION['transacoes'][$indice])){
            unset($_SESSION['transacoes'][$indice]);
            $_SESSION['transacoes'] = array_values($_SESSION['transacoes']);
        }

        header("Location: historico.php");
        exit;
    }

    // limpar transações
    if(isset($_GET['limpar'])){
        $_SESSION['transacoes'] = [];

        header("Location: historico.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Histórico</title>
</head>

<body>

    <h2>Histórico de Movimentações</h2>

    <a href="index.php">Voltar</a>
    <br><br>

    <a href="historico.php?limpar=1">Zerar</a>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Data</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>

    <?php foreach($_SESSION['transacoes'] as $index => $transacao): ?>

        <tr>
            <td><?= $transacao['data'] ?? '-' ?></td>

            <td><?= $transacao['descricao'] ?></td>

            <td><?= $transacao['tipo'] ?></td>

            <td>
                <?php if($transacao['tipo'] === 'Receita'): ?>
                    + <?= formatarReal($transacao['valor']) ?>
                <?php else: ?>
                    - <?= formatarReal($transacao['valor']) ?>
                <?php endif; ?>
            </td>

            <td>
                <a href="historico.php?excluir=<?= $index ?>">
                    Excluir
                </a>
            </td>
        </tr>

    <?php endforeach; ?>

    </table>
    
    <?php require 'footer.php'; ?>
</body>
</html>