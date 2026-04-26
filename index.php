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

    foreach($_SESSION['transacoes'] as $transacao){
        if($transacao['tipo'] === 'Receita'){
            $totalReceitas += $transacao['valor'];
        } else {
            $totalDespesas += $transacao['valor'];
        }
    }

    require 'header.php';
?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 mt-4">
    
    <div class="bg-white rounded-xl shadow-sm border-l-4 border-green-600 p-6 flex flex-col justify-center">
        <span class="text-sm font-semibold text-gray-500 mb-1">Total Receitas</span>
        <span class="text-3xl font-bold text-green-700"><?= formatarReal($totalReceitas) ?></span>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-l-4 border-red-500 p-6 flex flex-col justify-center">
        <span class="text-sm font-semibold text-gray-500 mb-1">Total Despesas</span>
        <span class="text-3xl font-bold text-red-500"><?= formatarReal($totalDespesas) ?></span>
    </div>

    <div class="bg-blue-600 rounded-xl shadow-sm p-6 flex flex-col justify-center">
        <span class="text-sm font-medium text-blue-100 mb-1">Saldo Disponível</span>
        <span class="text-3xl font-bold text-white"><?= formatarReal($saldo) ?></span>
    </div>

</div>

<div class="bg-white rounded-xl shadow-sm p-6 mb-8">
    <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Nova Transação</h3>
    
    <form method="post" action="index.php" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        
        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1 font-semibold uppercase">Descrição</label>
            <input type="text" name="descricao" placeholder="Ex: Salário, Aluguel..." required
                   class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1 font-semibold uppercase">Valor</label>
            <input type="number" step="0.01" name="valor" placeholder="0.00" required
                   class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex flex-col">
            <label class="text-xs text-gray-500 mb-1 font-semibold uppercase">Tipo</label>
            <select name="tipo" required class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                <option value="Receita">Receita</option>
                <option value="Despesa">Despesa</option>
            </select>
        </div>

        <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-md p-2 text-sm transition-colors h-[38px]">
            Adicionar
        </button>

    </form>
</div>

<div class="flex justify-center">
    <a href="historico.php" class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-6 rounded shadow-sm transition-colors text-sm">
        Ver Detalhes do Histórico
    </a>
</div>

<?php
require 'footer.php';
?>