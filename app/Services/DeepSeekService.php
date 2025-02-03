<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DeepSeekService
{
    protected $ollamaUrl;

    public function __construct()
    {
        $this->ollamaUrl = 'http://localhost:11434/api/generate'; // Ollama local server
    }

    public function generateResponse($prompt)
    {
        $response = Http::post($this->ollamaUrl, [
            'model' => 'deepseek-r1',
            'prompt' => $prompt,
            'stream' => false
        ]);

        return $response->json();
    }
}
