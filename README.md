# MyWallet - Gestão Financeira Pessoal

O **MyWallet** é uma aplicação web simples e funcional desenvolvida para o controle de finanças pessoais. O sistema permite que o usuário registre entradas (receitas) e saídas (despesas), acompanhe o saldo atual em tempo real e visualize um histórico detalhado das movimentações.

Este projeto foi desenvolvido como um trabalho acadêmico utilizando **PHP puro** e **Tailwind CSS**.

## 🚀 Funcionalidades

- **Controle de Acesso**: Área restrita protegida por sistema de login com autenticação segura (\`password_hash\` e \`password_verify\`).
- **Dashboard Financeiro**: Exibição dinâmica do Total de Receitas, Total de Despesas e Saldo Disponível.
- **Gestão de Transações**: Formulário para adicionar novas movimentações com descrição, valor e tipo.
- **Persistência de Dados**: Utilização de \`$_SESSION\` para manter os dados durante a navegação sem necessidade de banco de dados externo.
- **Histórico Detalhado**: Listagem de todas as operações realizadas com data, categoria e valor.
- **Cálculo de Relevância (Bônus)**: Cálculo automático do percentual que cada despesa representa em relação ao gasto total.
- **Gestão do Histórico**: Opções para excluir transações individuais ou zerar todo o mês/histórico.

## 🛠️ Tecnologias Utilizadas

- **Linguagem**: PHP 8.x
- **Estilização**: [Tailwind CSS v4](https://tailwindcss.com/) (via CDN)
- **Servidor Local**: Servidor embutido do PHP

## 📂 Estrutura do Projeto

O projeto segue uma arquitetura modular para facilitar a manutenção:

- `index.php`: Dashboard principal e formulário de cadastro.
- `login.php`: Página de autenticação.
- `logout.php`: Encerramento da sessão e redirecionamento.
- `historico.php`: Listagem de transações e cálculos de relevância.
- `funcoes.php`: Lógica de cálculos (saldo, percentual) e formatação de moeda.
- `header.php`: Cabeçalho comum e navegação (modularizado).
- `footer.php`: Rodapé e fechamento de tags (modularizado).

## 🔧 Como Executar

Não é necessário utilizar ambientes pesados como XAMPP ou WAMP. Basta ter o PHP instalado na sua máquina:

1. Transfira os arquivos para uma pasta local.
2. Abra o terminal na raiz da pasta do projeto.
3. Inicie o servidor embutido do PHP com o comando:
   ```bash
   php -S localhost:8000
   ```
4. Acesse no navegador e abra o endereço: `http://localhost:8000`

---
**Desenvolvido por:** Jonathan Blanc e Renata Thayna Bataier Ribeiro Malfatti
**Projeto Acadêmico © 2026**