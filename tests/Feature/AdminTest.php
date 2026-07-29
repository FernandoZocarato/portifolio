<?php

namespace Tests\Feature;

use App\Models\Profile;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'admin.email' => 'fernando@example.com',
            'admin.password_hash' => Hash::make('uma-senha-segura'),
        ]);
    }

    public function test_dashboard_requires_admin_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_only_configured_credentials_can_login(): void
    {
        $this->post('/admin/login', [
            'email' => 'outra-pessoa@example.com',
            'password' => 'uma-senha-segura',
        ])->assertSessionHasErrors('email');

        $this->post('/admin/login', [
            'email' => 'fernando@example.com',
            'password' => 'uma-senha-segura',
        ])->assertRedirect('/admin')->assertSessionHas('admin_authenticated', true);
    }

    public function test_authenticated_admin_can_update_profile(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->withSession(['admin_authenticated' => true])
            ->put('/admin/perfil', [
                'name' => 'Fernando Zocarato',
                'tagline' => 'Nova frase principal',
                'about' => 'Novo texto completo sobre o perfil.',
                'email' => 'fernando@example.com',
            ])
            ->assertRedirect()
            ->assertSessionHas('admin_success');

        $this->assertSame('Nova frase principal', Profile::query()->first()->tagline);
    }
}
