# Portfólio — Fernando Zocarato

Aplicação Laravel 10 compatível com PHP 8.1. O frontend foi reconstruído em Blade + Tailwind CSS, sem React/TanStack, mantendo a identidade visual criada no Lovable.

## Recursos

- Temas claro e escuro, respeitando o sistema e persistidos no navegador
- Layout responsivo e acessível
- Conteúdo de perfil, tecnologias, projetos e experiências vindo do MySQL
- Formulário com CSRF, validação, honeypot, rate limit e persistência
- API JSON em `/api/profile`, `/api/skills`, `/api/projects`, `/api/experiences` e `/api/contact`
- Seed sem experiências profissionais ou links inventados
- Testes Feature

## Instalação

Requisitos: PHP 8.1 ou superior, Composer 2 e Node.js 18+. O projeto usa SQLite por padrão, armazenado em `database/database.sqlite`.

```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

Acesse `http://127.0.0.1:8000`.

Para desenvolvimento dos assets:

```bash
npm run dev
```

## Banco de dados

SQLite é o padrão e mantém o banco dentro do próprio projeto. A configuração esperada no `.env` é:

```env
DB_CONNECTION=sqlite
```

Não é necessário definir `DB_DATABASE`; o Laravel usará `database/database.sqlite`.

## Testes

```bash
php artisan test
```

## Docker

```bash
docker compose up -d --build
docker compose exec app php artisan migrate --seed
```

> Este ambiente de geração não possuía PHP ou Composer. Execute localmente os comandos de instalação, migração e testes acima.
