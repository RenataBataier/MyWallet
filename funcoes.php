<?php
  // funcão para retornar o valor formatado com R$ na frente
  function formatarReal($valor) {
    return "R$ " . number_format($valor, 2, ',', '.');
  }

  function calcularSaldo($arrayTransacoes) {
    $saldo = 0;

    if (!empty($arrayTransacoes)) {
      foreach ($arrayTransacoes as $transacao) {
        if ($transacao['tipo'] === 'Receita') {
          $saldo += $transacao['valor'];
        } else if($transacao['tipo'] === 'Despesa') {
          $saldo -= $transacao['valor'];
        }
      }
    }

    return $saldo;
  }

  // função para calcular a relevância percentual
  function calcularPercentualDespesa($valorDespesa, $totalDespesas) {
    // evita divisão por zero caso não haja despesas
    if ($totalDespesas <= 0) {
        return 0; 
    }

    $percentual = ($valorDespesa / $totalDespesas) * 100;
    
    return round($percentual, 2); 

}

?>