@extends('layouts.app')

@section('content')
@php
    $profile ??= (object) [
        'name' => 'Fernando Zocarato',
        'tagline' => 'Transformando ideias em experiências digitais claras e funcionais',
        'about' => 'Este conteúdo pode ser personalizado com sua trajetória profissional.',
        'email' => null, 'github' => null, 'linkedin' => null,
    ];
@endphp

<header id="header" class="fixed inset-x-0 top-0 z-50 border-b border-transparent bg-slate-50/80 backdrop-blur-xl transition dark:bg-[#121b22]/80">
    <nav class="mx-auto flex h-18 max-w-6xl items-center justify-between px-5" aria-label="Navegação principal">
        <a href="#inicio" class="flex items-center gap-3 font-semibold tracking-tight">
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-[#183849] text-sm font-bold text-white">FZ</span>
            <span>Fernando Zocarato</span>
        </a>
        <div class="hidden items-center gap-6 md:flex">
            @foreach(['inicio'=>'Início','sobre'=>'Sobre','tecnologias'=>'Tecnologias','projetos'=>'Projetos','experiencia'=>'Experiência','contato'=>'Contato'] as $id => $label)
                <a class="nav-link text-sm text-slate-600 transition hover:text-teal-700 dark:text-slate-300 dark:hover:text-teal-300" href="#{{ $id }}">{{ $label }}</a>
            @endforeach
        </div>
        <div class="flex items-center gap-2">
            <button id="theme-toggle" class="icon-button" type="button" aria-label="Alternar tema">
                <span class="dark:hidden">☾</span><span class="hidden dark:inline">☀</span>
            </button>
            <button id="menu-toggle" class="icon-button md:hidden" type="button" aria-label="Abrir menu" aria-expanded="false">☰</button>
        </div>
    </nav>
    <div id="mobile-menu" class="mx-4 mb-3 hidden rounded-2xl border border-slate-200 bg-white p-3 shadow-xl dark:border-white/10 dark:bg-[#1b2933] md:hidden">
        @foreach(['inicio'=>'Início','sobre'=>'Sobre','tecnologias'=>'Tecnologias','projetos'=>'Projetos','experiencia'=>'Experiência','contato'=>'Contato'] as $id => $label)
            <a class="block rounded-lg px-3 py-2 text-sm hover:bg-slate-100 dark:hover:bg-white/5" href="#{{ $id }}">{{ $label }}</a>
        @endforeach
    </div>
</header>

<main>
    <section id="inicio" class="relative flex min-h-screen items-center overflow-hidden pt-24">
        <div class="hero-grid absolute inset-0 opacity-40" aria-hidden="true"></div>
        <div class="mx-auto grid w-full max-w-6xl items-center gap-16 px-5 py-24 lg:grid-cols-[1.15fr_.85fr]">
            <div class="relative z-10">
                <p class="mb-5 text-sm font-semibold uppercase tracking-[.2em] text-teal-700 dark:text-teal-300">Portfólio pessoal</p>
                <h1 class="max-w-3xl text-5xl font-bold leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl">{{ $profile->name }}</h1>
                <p class="mt-7 max-w-2xl text-xl leading-relaxed text-slate-600 dark:text-slate-300">{{ $profile->tagline }}</p>
                <div class="mt-10 flex flex-wrap gap-3">
                    <a href="#projetos" class="button-primary">Ver projetos <span aria-hidden="true">→</span></a>
                    <a href="#contato" class="button-secondary">Entrar em contato</a>
                    <span class="button-disabled" aria-disabled="true" title="Currículo ainda não fornecido">Currículo em breve</span>
                </div>
            </div>
            <div class="relative mx-auto aspect-square w-full max-w-md" aria-hidden="true">
                <div class="absolute inset-[8%] rotate-6 rounded-[3rem] border border-teal-700/20 bg-teal-700/5 dark:bg-teal-300/5"></div>
                <div class="absolute inset-[20%] -rotate-6 rounded-[2.5rem] bg-[#183849] shadow-2xl dark:bg-[#234655]"></div>
                <div class="absolute inset-[35%] grid place-items-center rounded-[2rem] bg-teal-700 text-5xl font-bold text-white shadow-xl">FZ</div>
                <div class="absolute right-[8%] top-[16%] h-16 w-16 rounded-full bg-[#556b2f]/70"></div>
                <div class="absolute bottom-[12%] left-[7%] h-10 w-10 rounded-xl bg-[#6d2948]/70"></div>
            </div>
        </div>
    </section>

    <section id="sobre" class="section">
        <div class="section-heading">
            <p class="eyebrow">Sobre</p>
            <h2>Clareza no código e atenção aos detalhes.</h2>
        </div>
        <div class="grid gap-6 lg:grid-cols-[1.3fr_.7fr]">
            <article class="card p-8 text-lg leading-8 text-slate-600 dark:text-slate-300">{{ $profile->about }}</article>
            <aside class="card grid gap-4 p-8">
                <p class="text-sm uppercase tracking-wider text-slate-500">Princípios do projeto</p>
                <p>Interfaces acessíveis</p><p>Arquitetura organizada</p><p>Experiência responsiva</p>
            </aside>
        </div>
    </section>

    <section id="tecnologias" class="section">
        <div class="section-heading">
            <p class="eyebrow">Tecnologias</p><h2>Ferramentas que compõem este modelo.</h2>
        </div>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
            @forelse($skills as $skill)
                <div class="card p-5">
                    <p class="font-semibold">{{ $skill->name }}</p>
                    <p class="mt-1 text-xs uppercase tracking-wider text-slate-500">{{ $skill->category }}</p>
                </div>
            @empty
                <p class="text-slate-500">Execute <code>php artisan migrate --seed</code> para carregar as tecnologias.</p>
            @endforelse
        </div>
    </section>

    <section id="projetos" class="section">
        <div class="section-heading">
            <p class="eyebrow">Projetos</p><h2>Cases demonstrativos, prontos para receber trabalhos reais.</h2>
        </div>
        <div class="grid gap-5 lg:grid-cols-3">
            @forelse($projects as $project)
                <article class="card group overflow-hidden">
                    <div class="project-visual"><span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span></div>
                    <div class="p-6">
                        @if($project->is_demo)<span class="badge">Projeto demonstrativo</span>@endif
                        <h3 class="mt-4 text-xl font-semibold">{{ $project->title }}</h3>
                        <p class="mt-3 leading-7 text-slate-600 dark:text-slate-300">{{ $project->summary }}</p>
                        <div class="mt-5 flex flex-wrap gap-2">
                            @foreach($project->technologies as $technology)<span class="tag">{{ $technology }}</span>@endforeach
                        </div>
                        <p class="mt-6 text-sm text-slate-400">Demonstração e código em breve</p>
                    </div>
                </article>
            @empty
                <p class="text-slate-500">Nenhum projeto cadastrado.</p>
            @endforelse
        </div>
    </section>

    <section id="experiencia" class="section">
        <div class="section-heading">
            <p class="eyebrow">Experiência</p><h2>Trajetória profissional.</h2>
        </div>
        @forelse($experiences as $experience)
            <article class="card mb-4 p-7">
                <h3 class="font-semibold">{{ $experience->role }} · {{ $experience->company }}</h3>
                <p class="mt-2 text-slate-500">{{ $experience->start_date->format('m/Y') }} — {{ $experience->end_date?->format('m/Y') ?? 'Atual' }}</p>
                <p class="mt-4">{{ $experience->description }}</p>
            </article>
        @empty
            <div class="card border-dashed p-10 text-center">
                <p class="text-lg font-medium">Adicione aqui sua trajetória profissional</p>
                <p class="mt-2 text-slate-500">Nenhuma experiência fictícia foi incluída.</p>
            </div>
        @endforelse
    </section>

    <section id="contato" class="section">
        <div class="grid gap-10 lg:grid-cols-[.8fr_1.2fr]">
            <div>
                <p class="eyebrow">Contato</p>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Vamos conversar sobre sua próxima ideia.</h2>
                <p class="mt-5 leading-7 text-slate-600 dark:text-slate-300">Preencha o formulário. A mensagem será registrada no sistema.</p>
                <div class="mt-8 space-y-3 text-sm text-slate-500">
                    <p>E-mail: {{ $profile->email ?: 'A adicionar' }}</p>
                    <p>GitHub: {{ $profile->github ?: 'A adicionar' }}</p>
                    <p>LinkedIn: {{ $profile->linkedin ?: 'A adicionar' }}</p>
                </div>
            </div>
            <form action="{{ route('contact.store') }}" method="post" class="card grid gap-5 p-7">
                @csrf
                <div class="hidden" aria-hidden="true"><label>Website<input name="website" tabindex="-1" autocomplete="off"></label></div>
                @if(session('success'))<div class="rounded-xl bg-emerald-100 p-4 text-emerald-900" role="status">{{ session('success') }}</div>@endif
                @if($errors->any())<div class="rounded-xl bg-red-100 p-4 text-red-900" role="alert">Revise os campos destacados.</div>@endif
                <div class="grid gap-5 sm:grid-cols-2">
                    <label>Nome<input class="input" name="name" value="{{ old('name') }}" required maxlength="120">@error('name')<span class="error">{{ $message }}</span>@enderror</label>
                    <label>E-mail<input class="input" type="email" name="email" value="{{ old('email') }}" required maxlength="255">@error('email')<span class="error">{{ $message }}</span>@enderror</label>
                </div>
                <label>Assunto<input class="input" name="subject" value="{{ old('subject') }}" required maxlength="180">@error('subject')<span class="error">{{ $message }}</span>@enderror</label>
                <label>Mensagem<textarea class="input min-h-36 resize-y" name="message" required minlength="10" maxlength="5000">{{ old('message') }}</textarea>@error('message')<span class="error">{{ $message }}</span>@enderror</label>
                <button class="button-primary justify-center" type="submit">Registrar mensagem</button>
            </form>
        </div>
    </section>
</main>

<footer class="border-t border-slate-200 py-8 dark:border-white/10">
    <div class="mx-auto flex max-w-6xl flex-col justify-between gap-2 px-5 text-sm text-slate-500 sm:flex-row">
        <p>© {{ now()->year }} {{ $profile->name }}.</p><p>Feito com atenção aos detalhes.</p>
    </div>
</footer>
@endsection
