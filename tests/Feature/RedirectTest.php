<?php

namespace Tests\Feature;

use App\Models\Redirect;
use App\Models\RedirectLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateRedirect()
    {
        // Cria um redirect fictício
        $redirect = Redirect::factory()->create();

        // Verifica se o redirect foi criado corretamente
        $this->assertInstanceOf(Redirect::class, $redirect);
    }

    public function testCreateRedirectLog()
    {
        // Cria um redirect fictício
        $redirect = Redirect::factory()->create();

        // Cria um redirect log associado ao redirect criado acima
        $redirectLog = RedirectLog::factory()->create([
            'redirect_id' => $redirect->id,
            'ip' => '192.168.1.1',
            'user_agent' => 'Test User Agent',
            'referer' => 'http://example.com',
            'query_params' => json_encode(['param1' => 'value1', 'param2' => 'value2']),
            'accessed_at' => now(),
        ]);

        // Verifica se o redirect log foi criado corretamente
        $this->assertInstanceOf(RedirectLog::class, $redirectLog);
    }
}
