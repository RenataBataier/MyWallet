<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyWallet</title>
    
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    
    <header class="bg-slate-900 text-white shadow-md">
        <div class="max-w-5xl mx-auto flex justify-between items-center px-4 py-5">
            
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                </svg>
                <h1 class="text-xl font-bold tracking-wide">MyWallet</h1>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-sm font-medium">Olá, Admin</span>
                
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-2 px-4 rounded transition-colors">
                    Sair
                </a>
            </div>
            
        </div>
    </header>

    <main class="flex-grow max-w-5xl mx-auto w-full p-4 mt-6">