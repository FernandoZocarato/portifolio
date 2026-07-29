<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateAdminPassword extends Command
{
    protected $signature = 'admin:password';

    protected $description = 'Gera um hash seguro para a senha da área administrativa';

    public function handle(): int
    {
        $password = $this->secret('Digite a nova senha do administrador');

        if (! is_string($password) || strlen($password) < 12) {
            $this->error('Use uma senha com pelo menos 12 caracteres.');

            return self::FAILURE;
        }

        $confirmation = $this->secret('Confirme a senha');

        if (! hash_equals($password, (string) $confirmation)) {
            $this->error('As senhas não conferem.');

            return self::FAILURE;
        }

        $this->newLine();
        $this->line('Adicione esta linha ao seu arquivo .env:');
        $this->newLine();
        $this->line("ADMIN_PASSWORD_HASH='".Hash::make($password)."'");

        return self::SUCCESS;
    }
}
