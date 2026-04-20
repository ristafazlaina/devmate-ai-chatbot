<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class ChatComponent extends Component
{
    public $message = '';
    public $chats = [];

    public function sendMessage()
    {
        if (empty($this->message)) return;

        // 1. Simpan pesan user ke array
        $this->chats[] = ['role' => 'user', 'content' => $this->message];
        $currentMessage = $this->message;
        $this->message = '';

        // 2. Panggil AI
        // 2. Panggil AI (Jalur khusus untuk Groq)
        $client = \OpenAI::factory()
            ->withApiKey(env('OPENAI_API_KEY'))
            ->withBaseUri('api.groq.com/openai/v1') // Kita paksa arahkan ke server Groq
            ->make();

        $result = $client->chat()->create([
            'model' => 'llama-3.1-8b-instant',
            'messages' => [
                ['role' => 'system', 'content' => 'Kamu adalah DevMate, asisten coding santai untuk mahasiswa IT. Kamu ahli di Laravel, Docker, dan IoT.'],
                ['role' => 'user', 'content' => $currentMessage],
            ],
        ]);

        // 3. Simpan respon AI
        $this->chats[] = ['role' => 'assistant', 'content' => $result->choices[0]->message->content];
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}