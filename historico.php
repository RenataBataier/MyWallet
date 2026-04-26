<?php
    session_start();

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

        $totalDespesas = 0;
    foreach($_SESSION['transacoes'] as $t) {
        if($t['tipo'] === 'Despesa') {
            $totalDespesas += $t['valor'];
        }
    }
    
    require 'header.php';
?>

<div class="bg-white rounded-xl shadow-sm p-6 mb-8 mt-4">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Histórico de Movimentações</h2>
        
        <div class="flex gap-3">
            <a href="index.php" class="border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                &larr; Voltar
            </a>
            
            <a href="historico.php?limpar=1" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
                Zerar
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="py-3 px-4 font-bold text-sm text-gray-800">Data</th>
                    <th class="py-3 px-4 font-bold text-sm text-gray-800">Descrição</th>
                    <th class="py-3 px-4 font-bold text-sm text-gray-800 text-center">Categoria</th>
                    <th class="py-3 px-4 font-bold text-sm text-gray-800 text-right">Valor</th>
                    <th class="py-3 px-4 font-bold text-sm text-gray-800 text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                
                <?php if (empty($_SESSION['transacoes'])): ?>
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">Nenhuma transação registada.</td>
                    </tr>
                <?php else: ?>
                    
                    <?php foreach($_SESSION['transacoes'] as $index => $transacao): ?>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            
                            <td class="py-4 px-4 text-sm text-gray-500">
                                <?= $transacao['data'] ?? date('d/m/Y H:i') ?>
                            </td>

                            <td class="py-4 px-4 text-sm font-bold text-gray-800">
                                <?= htmlspecialchars($transacao['descricao']) ?>
                            </td>

                            <td class="py-4 px-4 text-sm text-center">
                                <?php if($transacao['tipo'] === 'Receita'): ?>
                                    <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs font-semibold">Receita</span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-500 py-1 px-3 rounded-full text-xs font-semibold">Despesa</span>
                                <?php endif; ?>
                            </td>

                            <td class="py-4 px-4 text-sm font-bold text-right <?= $transacao['tipo'] === 'Receita' ? 'text-green-600' : 'text-red-500' ?>">
                                <div class="flex flex-col items-end">
                                    <span><?= $transacao['tipo'] === 'Receita' ? '+ ' : '- ' ?><?= formatarReal($transacao['valor']) ?></span>
                                    
                                    <?php if($transacao['tipo'] === 'Despesa'): ?>
                                        <span class="text-xs font-medium text-gray-400 mt-1 bg-gray-100 px-2 py-0.5 rounded">
                                            <?= calcularPercentualDespesa($transacao['valor'], $totalDespesas) ?>% do total
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td class="py-4 px-4 text-center">
                                <a href="historico.php?excluir=<?= $index ?>" class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-red-100 text-red-600 hover:bg-red-200 transition-colors" title="Excluir">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </td>
                            
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                
            </tbody>
        </table>
    </div>
</div>

<?php require 'footer.php'; ?>