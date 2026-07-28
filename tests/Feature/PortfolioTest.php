<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_renders_portfolio(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->get('/')
            ->assertOk()
            ->assertSee('Fernando Zocarato')
            ->assertSee('Projeto demonstrativo');
    }

    public function test_contact_is_validated_and_persisted(): void
    {
        $this->post('/contato', [
            'name' => 'Visitante',
            'email' => 'visitante@example.com',
            'subject' => 'Novo projeto',
            'message' => 'Gostaria de conversar sobre um projeto.',
        ])->assertRedirect('/')->assertSessionHas('success');

        $this->assertDatabaseHas(ContactMessage::class, ['email' => 'visitante@example.com']);
    }

    public function test_api_contracts(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->getJson('/api/profile')->assertOk()->assertJsonPath('name', 'Fernando Zocarato');
        $this->getJson('/api/skills')->assertOk()->assertJsonStructure([['name', 'category']]);
        $this->getJson('/api/projects')->assertOk()->assertJsonStructure([['id', 'title', 'technologies', 'isDemo']]);
        $this->getJson('/api/experiences')->assertOk()->assertExactJson([]);
    }
}
