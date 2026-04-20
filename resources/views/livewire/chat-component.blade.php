<div class="max-w-2xl mx-auto p-4 flex flex-col h-screen">
    <div class="flex-1 overflow-y-auto space-y-4 mb-4 p-4 border rounded-lg bg-gray-50">
        @foreach($chats as $chat)
            <div class="{{ $chat['role'] === 'user' ? 'text-right' : 'text-left' }}">
                <span class="inline-block p-3 rounded-lg {{ $chat['role'] === 'user' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-black' }}">
                    {!! nl2br(e($chat['content'])) !!}
                </span>
            </div>
        @endforeach
    </div>

    <form wire:submit.prevent="sendMessage" class="flex gap-2">
        <input type="text" wire:model="message" class="flex-1 border p-2 rounded-lg" placeholder="Tanya sesuatu tentang Laravel atau Docker...">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Kirim</button>
    </form>
</div>