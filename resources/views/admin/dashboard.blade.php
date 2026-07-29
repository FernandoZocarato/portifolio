@extends('layouts.admin')

@section('title', 'Painel')

@section('content')
@php
    $field = 'lov-input';
@endphp
<header class="sticky top-0 z-40 border-b border-border bg-background/90 backdrop-blur">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
        <div class="flex items-center gap-3">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary text-xs font-bold text-primary-foreground">FZ</span>
            <div><p class="text-sm font-semibold">Painel do portfólio</p><p class="text-xs text-muted-foreground">Acesso exclusivo</p></div>
        </div>
        <div class="flex items-center gap-1">
            <a class="lov-icon-button" href="{{ route('portfolio') }}" target="_blank" aria-label="Visualizar site"><i data-lucide="external-link" class="h-4 w-4"></i></a>
            <button id="theme-toggle" class="lov-icon-button" type="button" aria-label="Alternar tema"><i data-lucide="moon" class="h-5 w-5 dark:hidden"></i><i data-lucide="sun" class="hidden h-5 w-5 dark:block"></i></button>
            <form method="post" action="{{ route('admin.logout') }}">@csrf<button class="lov-icon-button" type="submit" aria-label="Sair"><i data-lucide="log-out" class="h-4 w-4"></i></button></form>
        </div>
    </div>
</header>

<main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-12">
    <div class="mb-8">
        <p class="section-eyebrow">Administração</p>
        <h1 class="text-3xl font-semibold tracking-tight">Conteúdo do site</h1>
        <p class="mt-2 text-sm text-muted-foreground">As alterações salvas aparecem imediatamente no portfólio.</p>
    </div>

    @if(session('admin_success'))
        <div class="mb-6 rounded-lg border border-primary/30 bg-primary/10 p-4 text-sm">{{ session('admin_success') }}</div>
    @endif
    @if($errors->any())
        <div class="mb-6 rounded-lg border border-destructive/30 bg-destructive/10 p-4 text-sm">
            <p class="font-semibold">Não foi possível salvar:</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <nav class="mb-8 flex flex-wrap gap-2" aria-label="Seções do painel">
        @foreach(['perfil'=>'Perfil','tecnologias'=>'Tecnologias','projetos'=>'Projetos','experiencias'=>'Experiências','mensagens'=>'Mensagens'] as $anchor=>$label)
            <a class="lov-button lov-button-outline h-9 px-3 text-xs" href="#{{ $anchor }}">{{ $label }}</a>
        @endforeach
    </nav>

    <section id="perfil" class="admin-section">
        <div class="admin-section-heading"><div><p class="section-eyebrow">Identidade</p><h2 class="text-2xl font-semibold">Perfil</h2></div></div>
        <form class="lov-card grid gap-4 p-5 sm:grid-cols-2 sm:p-6" method="post" action="{{ route('admin.profile.update') }}">
            @csrf @method('PUT')
            <label class="admin-label">Nome<input class="{{ $field }}" name="name" value="{{ old('name', $profile->name) }}" required></label>
            <label class="admin-label">Localização<input class="{{ $field }}" name="location" value="{{ old('location', $profile->location) }}"></label>
            <label class="admin-label sm:col-span-2">Frase principal<input class="{{ $field }}" name="tagline" value="{{ old('tagline', $profile->tagline) }}" required></label>
            <label class="admin-label sm:col-span-2">Sobre<textarea class="{{ $field }} min-h-36" name="about" required>{{ old('about', $profile->about) }}</textarea></label>
            <label class="admin-label">E-mail público<input class="{{ $field }}" type="email" name="email" value="{{ old('email', $profile->email) }}"></label>
            <label class="admin-label">GitHub (URL completa)<input class="{{ $field }}" type="url" name="github" value="{{ old('github', $profile->github) }}"></label>
            <label class="admin-label">LinkedIn (URL completa)<input class="{{ $field }}" type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}"></label>
            <div class="flex items-end sm:justify-end"><button class="lov-button lov-button-primary" type="submit"><i data-lucide="save" class="h-4 w-4"></i>Salvar perfil</button></div>
        </form>
    </section>

    <section id="tecnologias" class="admin-section">
        <div class="admin-section-heading"><div><p class="section-eyebrow">Stack</p><h2 class="text-2xl font-semibold">Tecnologias</h2></div></div>
        <form class="lov-card mb-4 grid gap-3 p-4 sm:grid-cols-[1fr_1fr_100px_auto]" method="post" action="{{ route('admin.skills.store') }}">
            @csrf
            <label class="admin-label">Nome<input class="{{ $field }}" name="name" required></label>
            <label class="admin-label">Categoria<input class="{{ $field }}" name="category" placeholder="backend, frontend..."></label>
            <label class="admin-label">Ordem<input class="{{ $field }}" type="number" min="0" name="sort_order" value="{{ $skills->count() }}" required></label>
            <div class="flex items-end"><button class="lov-button lov-button-primary w-full" type="submit"><i data-lucide="plus" class="h-4 w-4"></i>Adicionar</button></div>
        </form>
        <div class="space-y-3">
            @foreach($skills as $skill)
                <div class="lov-card flex flex-col gap-3 p-4 sm:flex-row sm:items-end">
                    <form id="skill-{{ $skill->id }}" class="grid flex-1 gap-3 sm:grid-cols-[1fr_1fr_100px]" method="post" action="{{ route('admin.skills.update', $skill) }}">
                        @csrf @method('PUT')
                        <label class="admin-label">Nome<input class="{{ $field }}" name="name" value="{{ $skill->name }}" required></label>
                        <label class="admin-label">Categoria<input class="{{ $field }}" name="category" value="{{ $skill->category }}"></label>
                        <label class="admin-label">Ordem<input class="{{ $field }}" type="number" min="0" name="sort_order" value="{{ $skill->sort_order }}" required></label>
                    </form>
                    <div class="flex gap-2"><button class="lov-button lov-button-outline flex-1" form="skill-{{ $skill->id }}" type="submit"><i data-lucide="save" class="h-4 w-4"></i>Salvar</button><form method="post" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Remover esta tecnologia?')">@csrf @method('DELETE')<button class="lov-icon-button text-destructive" type="submit" aria-label="Remover"><i data-lucide="trash-2" class="h-4 w-4"></i></button></form></div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="projetos" class="admin-section">
        <div class="admin-section-heading"><div><p class="section-eyebrow">Portfólio</p><h2 class="text-2xl font-semibold">Projetos</h2></div></div>
        <details class="lov-card mb-4 p-5">
            <summary class="cursor-pointer font-semibold">Adicionar novo projeto</summary>
            <form class="mt-5 grid gap-4 sm:grid-cols-2" method="post" action="{{ route('admin.projects.store') }}">
                @csrf
                @include('admin.partials.project-fields', ['project' => null, 'field' => $field])
                <div class="sm:col-span-2"><button class="lov-button lov-button-primary" type="submit"><i data-lucide="plus" class="h-4 w-4"></i>Adicionar projeto</button></div>
            </form>
        </details>
        <div class="space-y-4">
            @foreach($projects as $project)
                <details class="lov-card p-5" @if($loop->first) open @endif>
                    <summary class="cursor-pointer font-semibold">{{ $project->title }}</summary>
                    <form class="mt-5 grid gap-4 sm:grid-cols-2" method="post" action="{{ route('admin.projects.update', $project) }}">
                        @csrf @method('PUT')
                        @include('admin.partials.project-fields', ['project' => $project, 'field' => $field])
                        <div class="flex flex-wrap gap-2 sm:col-span-2">
                            <button class="lov-button lov-button-primary" type="submit"><i data-lucide="save" class="h-4 w-4"></i>Salvar projeto</button>
                        </div>
                    </form>
                    <form class="mt-2" method="post" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Remover este projeto?')">@csrf @method('DELETE')<button class="lov-button lov-button-ghost text-destructive" type="submit"><i data-lucide="trash-2" class="h-4 w-4"></i>Remover projeto</button></form>
                </details>
            @endforeach
        </div>
    </section>

    <section id="experiencias" class="admin-section">
        <div class="admin-section-heading"><div><p class="section-eyebrow">Carreira</p><h2 class="text-2xl font-semibold">Experiências</h2></div></div>
        <details class="lov-card mb-4 p-5" @if($experiences->isEmpty()) open @endif>
            <summary class="cursor-pointer font-semibold">Adicionar experiência</summary>
            <form class="mt-5 grid gap-4 sm:grid-cols-2" method="post" action="{{ route('admin.experiences.store') }}">
                @csrf
                @include('admin.partials.experience-fields', ['experience' => null, 'field' => $field])
                <div class="sm:col-span-2"><button class="lov-button lov-button-primary" type="submit"><i data-lucide="plus" class="h-4 w-4"></i>Adicionar experiência</button></div>
            </form>
        </details>
        <div class="space-y-4">
            @foreach($experiences as $experience)
                <details class="lov-card p-5">
                    <summary class="cursor-pointer font-semibold">{{ $experience->role }} · {{ $experience->company }}</summary>
                    <form class="mt-5 grid gap-4 sm:grid-cols-2" method="post" action="{{ route('admin.experiences.update', $experience) }}">
                        @csrf @method('PUT')
                        @include('admin.partials.experience-fields', ['experience' => $experience, 'field' => $field])
                        <div class="sm:col-span-2"><button class="lov-button lov-button-primary" type="submit"><i data-lucide="save" class="h-4 w-4"></i>Salvar experiência</button></div>
                    </form>
                    <form class="mt-2" method="post" action="{{ route('admin.experiences.destroy', $experience) }}" onsubmit="return confirm('Remover esta experiência?')">@csrf @method('DELETE')<button class="lov-button lov-button-ghost text-destructive" type="submit"><i data-lucide="trash-2" class="h-4 w-4"></i>Remover experiência</button></form>
                </details>
            @endforeach
        </div>
    </section>

    <section id="mensagens" class="admin-section">
        <div class="admin-section-heading"><div><p class="section-eyebrow">Contato</p><h2 class="text-2xl font-semibold">Mensagens recebidas</h2></div><span class="lov-pill">{{ $messages->count() }}</span></div>
        <div class="space-y-3">
            @forelse($messages as $message)
                <article class="lov-card p-5">
                    <div class="flex flex-col justify-between gap-3 sm:flex-row">
                        <div><h3 class="font-semibold">{{ $message->subject }}</h3><p class="mt-1 text-sm text-muted-foreground">{{ $message->name }} · <a class="text-primary hover:underline" href="mailto:{{ $message->email }}">{{ $message->email }}</a> · {{ $message->created_at->format('d/m/Y H:i') }}</p></div>
                        <form method="post" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Excluir esta mensagem?')">@csrf @method('DELETE')<button class="lov-icon-button text-destructive" type="submit" aria-label="Excluir mensagem"><i data-lucide="trash-2" class="h-4 w-4"></i></button></form>
                    </div>
                    <p class="mt-4 whitespace-pre-line text-sm">{{ $message->message }}</p>
                </article>
            @empty
                <div class="rounded-xl border border-dashed border-border p-8 text-center text-sm text-muted-foreground">Nenhuma mensagem recebida.</div>
            @endforelse
        </div>
    </section>
</main>
@endsection
