<div class="flex flex-col h-screen bg-white font-sans antialiased text-gray-900">
    <header class="p-6 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10">
        <div>
            <h1 class="text-xl font-bold tracking-tighter">DEVMATE.AI</h1>
            <p class="text-xs text-gray-400 uppercase tracking-widest">Coding Assistant v1.0</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span class="text-xs font-medium text-gray-500">System Online</span>
        </div>
    </header>

    <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50/50">
        @if(count($chats) == 0)
            <div class="h-full flex flex-col items-center justify-center text-center opacity-40">
                <p class="text-sm">Belum ada percakapan.<br>Tanyakan sesuatu tentang Laravel atau IoT.</p>
            </div>
        @endif

        @foreach($chats as $chat)
            <div class="flex {{ $chat['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[85%] px-5 py-3 rounded-2xl shadow-sm {{ $chat['role'] === 'user' 
                    ? 'bg-black text-white rounded-tr-none' 
                    : 'bg-white border border-gray-200 text-gray-800 rounded-tl-none' }}">
                    <p class="text-sm leading-relaxed">{!! nl2br(e($chat['content'])) !!}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="p-6 bg-white border-t border-gray-100">
        <form wire:submit.prevent="sendMessage" class="relative max-w-4xl mx-auto">
            <input type="text" wire:model="message" 
                class="w-full pl-6 pr-16 py-4 bg-gray-100 border-none rounded-full focus:ring-2 focus:ring-black transition-all text-sm" 
                placeholder="Type your message here...">
            
            <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-black text-white rounded-full hover:bg-gray-800 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </form>
    </div>
</div>