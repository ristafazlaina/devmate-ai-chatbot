<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI;

class ChatComponent extends Component
{
    public $message = '';
    public $chats = [];

    public function sendMessage()
    {
        if (empty($this->message)) return;

        // Tambah pesan user
        $this->chats[] = ['role' => 'user', 'content' => $this->message];
        $currentMessage = $this->message;
        $this->message = '';

        try {
            $client = OpenAI::factory()
                ->withApiKey(env('OPENAI_API_KEY'))
                ->withBaseUri('api.groq.com/openai/v1')
                ->make();

            $result = $client->chat()->create([
                'model' => 'llama-3.1-8b-instant',
                'messages' => [
                    ['role' => 'system', 'content' => 'Kamu adalah DevMate, asisten coding yang solutif dan estetik. Jawablah dengan singkat dan jelas.'],
                    ['role' => 'user', 'content' => $currentMessage],
                ],
            ]);

            $this->chats[] = ['role' => 'assistant', 'content' => $result->choices[0]->message->content];
        } catch (\Exception $e) {
            $this->chats[] = ['role' => 'assistant', 'content' => 'Aduh, ada gangguan koneksi. Coba lagi ya!'];
        }
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}