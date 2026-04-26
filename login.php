<?php
session_start();

$fezLogin = $_SESSION['logado'] ?? null;
if($fezLogin){
    header("Location: index.php");
}

$hashSenha = password_hash("1234", PASSWORD_DEFAULT);
$erro = "";

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
            $erro = "<h4>Por favor, verifique se o login e senha estão corretos.</h4>";
        }
    }else {
        $erro = "<h4>Fazer Login</h4>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyWallet</title>
    
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-400 via-purple-500 to-indigo-800 p-4 font-sans">

    <div class="w-full max-w-[400px] bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col">
        
        <div class="bg-[#1e2229] flex flex-col items-center justify-center pt-10 pb-8 px-6 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
            </svg>
            <h1 class="text-3xl font-bold tracking-wide mb-1">MyWallet</h1>
            <p class="text-gray-400 text-sm">Gestão Financeira Pessoal</p>
        </div>

        <div class="p-8">
            
            <?php if($erro): ?>
                <div class="bg-red-100 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm font-medium mb-6 text-center">
                    <?= $erro ?>
                </div>
            <?php endif; ?>

            <form action="" method="post" class="space-y-5">
                
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Utilizador</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                        <input type="text" name="usuario" placeholder="admin" required
                               class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Palavra-passe</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <input type="password" name="senha" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;" required
                               class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-colors">
                    </div>
                </div>

                <button type="submit" 
                        class="w-full mt-2 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-bold rounded-lg shadow-md transition-all">
                    ENTRAR NO SISTEMA
                </button>

            </form>
        </div>

        <div class="bg-gray-50 py-4 text-center border-t border-gray-100">
            <p class="text-xs text-gray-500">PHP Academic Project &copy; 2024</p>
        </div>

    </div>

</body>
</html>