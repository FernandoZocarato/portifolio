<!doctype html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portfólio pessoal de Fernando Zocarato: projetos, tecnologias e contato.">
    <meta name="theme-color" content="#152833">
    <meta property="og:title" content="Fernando Zocarato — Portfólio">
    <meta property="og:description" content="Transformando ideias em experiências digitais claras e funcionais.">
    <meta property="og:type" content="website">
    <title>Fernando Zocarato — Portfólio</title>
    <script>
        (() => {
            const saved = localStorage.getItem('fz-theme');
            const dark = saved ? saved === 'dark' : matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', dark);
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased selection:bg-teal-700 selection:text-white dark:bg-[#121b22] dark:text-slate-100">
    <a href="#inicio" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-teal-700 focus:px-4 focus:py-2 focus:text-white">Pular para o conteúdo</a>
    @yield('content')
</body>
</html>
