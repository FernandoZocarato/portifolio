<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function (): void {
    $this->comment('Transformando ideias em experiências digitais claras e funcionais.');
})->purpose('Exibe uma mensagem do projeto');
