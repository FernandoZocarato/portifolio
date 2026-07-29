@extends('layouts.app')

@section('content')
@php
    $profile ??= (object) ['name'=>'Fernando Zocarato','tagline'=>'Transformando ideias em experiências digitais claras e funcionais','about'=>'Este conteúdo pode ser personalizado com sua trajetória profissional.','email'=>null,'github'=>null,'linkedin'=>null];
    $nav = ['inicio'=>'Início','sobre'=>'Sobre','tecnologias'=>'Tecnologias','projetos'=>'Projetos','experiencia'=>'Experiência','contato'=>'Contato'];
@endphp

<header id="header" class="sticky top-0 z-50 w-full bg-transparent transition-all">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
        <a href="#inicio" class="flex items-center gap-2 rounded-md text-sm font-semibold tracking-tight text-foreground" aria-label="Ir para o início">
            <span class="grid h-8 w-8 place-items-center rounded-md bg-primary text-xs font-bold text-primary-foreground">FZ</span>
            <span class="hidden sm:inline">Fernando Zocarato</span>
        </a>
        <nav class="hidden md:block" aria-label="Navegação principal">
            <ul class="flex items-center gap-1">
                @foreach($nav as $id=>$label)
                    <li><a class="nav-link block rounded-md px-3 py-2 text-sm text-muted-foreground transition-colors hover:text-foreground" href="#{{ $id }}">{{ $label }}</a></li>
                @endforeach
            </ul>
        </nav>
        <div class="flex items-center gap-1">
            <button id="theme-toggle" class="lov-icon-button" type="button" aria-label="Alternar tema"><i data-lucide="moon" class="h-5 w-5 dark:hidden"></i><i data-lucide="sun" class="hidden h-5 w-5 dark:block"></i></button>
            <button id="menu-toggle" class="lov-icon-button md:hidden" type="button" aria-label="Abrir menu" aria-expanded="false"><i id="menu-icon" data-lucide="menu" class="h-5 w-5"></i><i id="close-icon" data-lucide="x" class="hidden h-5 w-5"></i></button>
        </div>
    </div>
    <nav id="mobile-menu" class="hidden border-t border-border bg-background md:hidden" aria-label="Navegação móvel">
        <ul class="mx-auto flex max-w-6xl flex-col px-2 py-2">
            @foreach($nav as $id=>$label)
                <li><a class="block rounded-md px-3 py-3 text-sm text-muted-foreground transition hover:bg-secondary hover:text-foreground" href="#{{ $id }}">{{ $label }}</a></li>
            @endforeach
        </ul>
    </nav>
</header>

<main>
    <section id="inicio" class="relative overflow-hidden" aria-labelledby="hero-title">
        <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
            <div class="hero-glow-one absolute -right-24 -top-32 h-96 w-96 rounded-full blur-3xl"></div>
            <div class="hero-glow-two absolute -left-24 top-40 h-72 w-72 rounded-full blur-3xl"></div>
            <div class="hero-grid absolute inset-0 text-foreground"></div>
        </div>
        <div class="mx-auto grid max-w-6xl gap-10 px-4 pb-20 pt-16 sm:px-6 sm:pb-28 sm:pt-24 md:grid-cols-[1.2fr_1fr] md:items-center md:gap-12">
            <div>
                <p class="mb-4 inline-flex items-center gap-2 rounded-full border border-border bg-secondary px-3 py-1 text-xs font-medium text-muted-foreground">
                    <span class="h-1.5 w-1.5 rounded-full bg-accent"></span>Portfólio pessoal
                </p>
                <h1 id="hero-title" class="text-4xl font-semibold tracking-tight text-foreground sm:text-5xl md:text-6xl">{{ $profile->name }}</h1>
                <p class="mt-4 max-w-xl text-lg text-muted-foreground sm:text-xl">{{ $profile->tagline }}</p>
                <p class="mt-4 max-w-xl text-sm text-muted-foreground sm:text-base">{{ $profile->about }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="lov-button lov-button-lg lov-button-primary" href="#projetos">Ver projetos <i data-lucide="arrow-right" class="h-4 w-4"></i></a>
                    <a class="lov-button lov-button-lg lov-button-outline" href="#contato"><i data-lucide="mail" class="h-4 w-4"></i><span>Entrar em contato</span></a>
                    <span class="lov-button lov-button-lg lov-button-ghost opacity-50" aria-disabled="true"><i data-lucide="download" class="h-4 w-4"></i><span>Currículo em breve</span></span>
                </div>
            </div>
            <div class="relative mx-auto hidden aspect-square w-full max-w-sm md:block" aria-hidden="true">
                <div class="absolute inset-4 rounded-3xl border border-border bg-card shadow-sm"></div>
                <div class="absolute inset-10 rounded-2xl border border-primary bg-background shadow-sm"></div>
                <div class="hero-gradient absolute inset-x-14 top-14 h-24 rounded-xl"></div>
                <div class="absolute bottom-10 left-14 right-24 h-3 rounded-full bg-muted"></div>
                <div class="absolute bottom-16 left-14 right-40 h-3 rounded-full bg-muted"></div>
                <div class="absolute bottom-6 right-10 h-16 w-16 rounded-full border border-accent bg-secondary"></div>
                <div class="absolute right-8 top-8 grid grid-cols-3 gap-1.5">@for($i=0;$i<9;$i++)<span class="h-1.5 w-1.5 rounded-full bg-muted-foreground"></span>@endfor</div>
            </div>
        </div>
    </section>

    <section id="sobre" class="portfolio-section"><div class="section-wrap">
        <div class="section-head"><p class="section-eyebrow">Sobre</p><h2 class="section-title">Um pouco sobre mim</h2><p class="section-description">Este é um espaço editável — atualize com o texto que representa você.</p></div>
        <div class="grid gap-8 md:grid-cols-3">
            <div class="md:col-span-2"><p class="text-lg leading-relaxed text-foreground">{{ $profile->about }}</p><p class="mt-4 text-base text-muted-foreground">Gosto de construir produtos com foco em clareza, boa arquitetura e experiência de uso. Curioso por natureza, aprendo continuamente e valorizo colaboração honesta.</p></div>
            <aside class="lov-card p-6"><h3 class="text-sm font-semibold">Foco atual</h3><ul class="mt-3 space-y-2 text-sm text-muted-foreground"><li>• Aplicações web full-stack</li><li>• APIs robustas com Laravel</li><li>• Interfaces com Blade e Tailwind</li><li>• Boas práticas e acessibilidade</li></ul></aside>
        </div>
    </div></section>

    <section id="tecnologias" class="portfolio-section"><div class="section-wrap">
        <div class="section-head"><p class="section-eyebrow">Tecnologias</p><h2 class="section-title">Stack de trabalho</h2><p class="section-description">Ferramentas com as quais tenho maior afinidade no dia a dia. Lista editável.</p></div>
        <ul class="flex flex-wrap gap-2">@foreach($skills as $skill)<li class="lov-pill">{{ $skill->name }}</li>@endforeach</ul>
    </div></section>

    <section id="projetos" class="portfolio-section"><div class="section-wrap">
        <div class="section-head"><p class="section-eyebrow">Projetos</p><h2 class="section-title">Trabalhos selecionados</h2><p class="section-description">Cases demonstrativos que ilustram tipos de projetos que gosto de construir.</p></div>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($projects as $project)
                <article class="group flex flex-col overflow-hidden rounded-2xl border border-border bg-card shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-md">
                    <div class="project-visual relative h-40 w-full overflow-hidden">
                        <div class="project-blob-one absolute -top-5 h-40 w-40 rounded-full blur-2xl" style="left:{{ ($loop->index * 47) % 180 }}px"></div>
                        <div class="project-blob-two absolute -bottom-8 right-5 h-28 w-28 rounded-full blur-2xl"></div>
                        <div class="absolute inset-0 grid place-items-center"><div class="grid grid-cols-4 gap-2">@for($i=0;$i<12;$i++)<span class="h-2 w-6 rounded-full bg-muted-foreground" style="opacity:{{ .25 + (($i+$loop->index)%7)/12 }}"></span>@endfor</div></div>
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <div class="mb-2 flex flex-wrap items-center gap-2"><h3 class="text-lg font-semibold">{{ $project->title }}</h3>@if($project->is_demo)<span class="rounded-md border border-border px-2 py-0.5 text-[10px] uppercase tracking-wider text-muted-foreground">Projeto demonstrativo</span>@endif</div>
                        <p class="text-sm text-muted-foreground">{{ $project->summary }}</p>
                        <ul class="mt-4 flex flex-wrap gap-1.5">@foreach($project->technologies as $technology)<li class="lov-tag">{{ $technology }}</li>@endforeach</ul>
                        <div class="mt-5 flex flex-nowrap items-center gap-1.5 pt-2">
                            @if($project->demo_url)<a class="lov-button lov-button-outline h-9 shrink-0 gap-1.5 px-2.5 text-xs" href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer"><i data-lucide="external-link" class="h-3.5 w-3.5"></i>Ver demo</a>@else<span class="lov-button lov-button-outline h-9 shrink-0 gap-1.5 px-2.5 text-xs opacity-50"><i data-lucide="external-link" class="h-3.5 w-3.5"></i>Demo — Em breve</span>@endif
                            @if($project->code_url)<a class="lov-button lov-button-ghost h-9 shrink-0 gap-1.5 px-2.5 text-xs" href="{{ $project->code_url }}" target="_blank" rel="noopener noreferrer"><i data-lucide="code-2" class="h-3.5 w-3.5"></i>Ver código</a>@else<span class="lov-button lov-button-ghost h-9 shrink-0 gap-1.5 px-2.5 text-xs opacity-50"><i data-lucide="code-2" class="h-3.5 w-3.5"></i>Código — Em breve</span>@endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div></section>

    <section id="experiencia" class="portfolio-section"><div class="section-wrap">
        <div class="section-head"><p class="section-eyebrow">Experiência</p><h2 class="section-title">Trajetória profissional</h2></div>
        @forelse($experiences as $experience)
            <article class="relative mb-8 border-l border-border pl-6"><p class="text-xs uppercase tracking-wider text-muted-foreground">{{ $experience->start_date->format('m/Y') }} — {{ $experience->end_date?->format('m/Y') ?? 'Atual' }}</p><h3 class="mt-1 text-lg font-semibold">{{ $experience->role }} · <span class="text-primary">{{ $experience->company }}</span></h3><p class="mt-2 text-sm text-muted-foreground">{{ $experience->description }}</p></article>
        @empty
            <div class="rounded-2xl border border-dashed border-border bg-card p-10 text-center"><div class="mx-auto grid h-12 w-12 place-items-center rounded-full bg-secondary text-muted-foreground"><i data-lucide="sparkles" class="h-5 w-5"></i></div><h3 class="mt-4 text-lg font-semibold">Sua história vai aqui</h3><p class="mx-auto mt-2 max-w-md text-sm text-muted-foreground">Adicione aqui sua trajetória profissional — cargos, empresas, períodos e principais entregas. Este texto é editável.</p></div>
        @endforelse
    </div></section>

    <section id="contato" class="portfolio-section"><div class="section-wrap">
        <div class="section-head"><p class="section-eyebrow">Contato</p><h2 class="section-title">Vamos conversar</h2><p class="section-description">Envie uma mensagem ou use os canais abaixo. Espaços editáveis — nenhum link é inventado.</p></div>
        <div class="grid gap-8 md:grid-cols-[1fr_1.2fr]">
            <aside class="space-y-3">
                @foreach([['mail','E-mail',$profile->email ?: 'Adicione seu e-mail',$profile->email ? 'mailto:'.$profile->email : null],['code-2','GitHub',$profile->github ?: 'Adicione seu perfil',$profile->github],['briefcase-business','LinkedIn',$profile->linkedin ?: 'Adicione seu perfil',$profile->linkedin]] as [$icon,$label,$value,$url])
                    @if($url)<a class="flex items-center gap-3 rounded-xl border border-border bg-card p-4 text-sm shadow-sm transition hover:-translate-y-0.5 hover:shadow-md" href="{{ $url }}" @if($label !== 'E-mail') target="_blank" rel="noopener noreferrer" @endif>@else<div class="flex items-center gap-3 rounded-xl border border-border bg-card p-4 text-sm shadow-sm">@endif
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-lg bg-secondary"><i data-lucide="{{ $icon }}" class="h-4 w-4"></i></span><span class="min-w-0"><span class="block text-xs uppercase tracking-wider text-muted-foreground">{{ $label }}</span><span class="block truncate text-foreground">{{ $value }}</span></span>
                    @if($url)</a>@else</div>@endif
                @endforeach
            </aside>
            <form action="{{ route('contact.store') }}" method="post" class="lov-card p-6">@csrf
                <input class="hidden" name="website" tabindex="-1" autocomplete="off">
                @if(session('success'))<p class="mb-4 rounded-md bg-secondary p-3 text-sm">{{ session('success') }}</p>@endif
                <div class="grid gap-4 sm:grid-cols-2"><label class="text-sm">Nome<input class="lov-input" name="name" value="{{ old('name') }}" required></label><label class="text-sm">E-mail<input class="lov-input" type="email" name="email" value="{{ old('email') }}" required></label></div>
                <label class="mt-4 block text-sm">Assunto<input class="lov-input" name="subject" value="{{ old('subject') }}" required></label>
                <label class="mt-4 block text-sm">Mensagem<textarea class="lov-input min-h-32 resize-y" name="message" required>{{ old('message') }}</textarea></label>
                @if($errors->any())<p class="mt-3 text-xs text-destructive">Revise os campos e tente novamente.</p>@endif
                <div class="mt-6 flex items-center justify-between gap-4"><p class="text-xs text-muted-foreground">A mensagem será registrada no sistema.</p><button class="lov-button lov-button-primary" type="submit"><i data-lucide="send" class="h-4 w-4"></i>Enviar mensagem</button></div>
            </form>
        </div>
    </div></section>
</main>

<footer class="border-t border-border py-8"><div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-2 px-4 text-sm text-muted-foreground sm:flex-row sm:px-6"><p>© {{ now()->year }} {{ $profile->name }}. Todos os direitos reservados.</p><p class="text-xs">Feito com atenção aos detalhes.</p></div></footer>
@endsection
