@extends('layouts.admin')

@section('title', 'Entrar')

@section('content')
<main class="grid min-h-screen place-items-center px-4 py-12">
    <section class="lov-card w-full max-w-md p-6 sm:p-8" aria-labelledby="login-title">
        <div class="mb-8 flex items-center gap-3">
            <span class="grid h-10 w-10 place-items-center rounded-lg bg-primary text-sm font-bold text-primary-foreground">FZ</span>
            <div>
                <p class="text-xs uppercase tracking-wider text-muted-foreground">Portfólio</p>
                <h1 id="login-title" class="text-xl font-semibold">Área administrativa</h1>
            </div>
        </div>

        @if(!config('admin.email') || !config('admin.password_hash'))
            <div class="mb-5 rounded-lg border border-destructive/30 bg-destructive/10 p-3 text-sm">
                Configure <code>ADMIN_EMAIL</code> e <code>ADMIN_PASSWORD_HASH</code> no arquivo <code>.env</code>.
            </div>
        @endif

        <form method="post" action="{{ route('admin.login.store') }}">
            @csrf
            <label class="block text-sm font-medium">
                E-mail
                <input class="lov-input" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
            </label>
            <label class="mt-4 block text-sm font-medium">
                Senha
                <input class="lov-input" type="password" name="password" autocomplete="current-password" required>
            </label>

            @error('email')<p class="mt-3 text-sm text-destructive">{{ $message }}</p>@enderror
            @if($errors->has('password'))<p class="mt-3 text-sm text-destructive">{{ $errors->first('password') }}</p>@endif

            <button class="lov-button lov-button-primary mt-6 w-full" type="submit">
                <i data-lucide="log-in" class="h-4 w-4"></i>Entrar
            </button>
        </form>
        <a href="{{ route('portfolio') }}" class="mt-5 block text-center text-sm text-muted-foreground hover:text-foreground">Voltar ao site</a>
    </section>
</main>
@endsection
