<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Profile::query()->updateOrCreate(['name' => 'Fernando Zocarato'], [
            'tagline' => 'Transformando ideias em experiências digitais claras e funcionais',
            'about' => 'Desenvolvedor interessado em construir interfaces claras, sistemas confiáveis e experiências que resolvem problemas reais. Este texto é editável e não representa histórico profissional não confirmado.',
        ]);

        foreach ([
            ['PHP', 'backend'], ['Laravel', 'backend'], ['JavaScript', 'frontend'],
            ['Blade', 'frontend'], ['Tailwind CSS', 'frontend'], ['MySQL', 'database'],
            ['Git', 'tools'], ['GitHub', 'tools'],
        ] as $index => [$name, $category]) {
            Skill::query()->updateOrCreate(['name' => $name], [
                'category' => $category,
                'sort_order' => $index,
            ]);
        }

        foreach ([
            ['Dashboard Financeiro', 'Painel demonstrativo para visualizar receitas, despesas e indicadores com filtros por período.', ['Laravel', 'Blade', 'Tailwind CSS', 'MySQL']],
            ['Sistema de Gestão', 'Aplicação demonstrativa para organizar clientes, pedidos, estoque e relatórios.', ['Laravel', 'PHP', 'MySQL', 'Blade']],
            ['Landing Page Profissional', 'Página demonstrativa responsiva com foco em desempenho, acessibilidade e comunicação clara.', ['Laravel', 'Blade', 'Tailwind CSS']],
        ] as $index => [$title, $summary, $technologies]) {
            Project::query()->updateOrCreate(['title' => $title], [
                'summary' => $summary,
                'technologies' => $technologies,
                'is_demo' => true,
                'sort_order' => $index,
            ]);
        }
    }
}
