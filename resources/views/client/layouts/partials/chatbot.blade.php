<div x-data="{
    isOpen: false,
    inputMessage: '',
    messages: [
        { id: 1, text: 'Chào bạn! Tôi là trợ lý ảo của Luxe Shop. Tôi có thể giúp gì cho bạn?', isUser: false }
    ],
    isTyping: false,
    hasNewMessage: true,

    toggleChat() {
        this.isOpen = !this.isOpen;
        if (this.isOpen) {
            this.hasNewMessage = false;
            this.scrollToBottom();
        }
    },

    async sendMessage() {
        if (!this.inputMessage.trim()) return;

        const userMsg = this.inputMessage;
        this.messages.push({
            id: Date.now(),
            text: userMsg,
            isUser: true
        });
        
        this.inputMessage = '';
        this.isTyping = true;
        this.scrollToBottom();

        try {
            const response = await fetch('{{ route('chatbot.send') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                },
                body: JSON.stringify({ message: userMsg })
            });

            const data = await response.json();
            
            setTimeout(() => {
                this.messages.push({
                    id: Date.now() + 1,
                    text: data.reply,
                    suggestions: data.suggestions || [], // Receive suggestions
                    isUser: false
                });
                this.isTyping = false;
                this.scrollToBottom();
            }, 500);

        } catch (error) {
            console.error('Chat error:', error);
            this.isTyping = false;
            this.messages.push({
                id: Date.now() + 1,
                text: 'Xin lỗi, có lỗi xảy ra. Vui lòng thử lại sau.',
                isUser: false
            });
        }
    },

    scrollToBottom() {
        this.$nextTick(() => {
            const container = document.getElementById('chatMessages');
            if(container) container.scrollTop = container.scrollHeight;
        });
    }
}" 
class="fixed bottom-6 right-6 z-[9999] flex flex-col items-end gap-4" x-cloak>

    <!-- Chat Window -->
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300 origin-bottom-right"
         x-transition:enter-start="opacity-0 scale-90 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 origin-bottom-right"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-90 translate-y-4"
         class="w-[320px] max-w-[85vw] bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col"
         style="height: 400px; display: none;">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-blue-600 p-4 text-white flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <i class="fa-solid fa-robot text-lg"></i>
                </div>
                <div>
                    <h3 class="font-bold text-sm">Luxe Bot</h3>
                    <p class="text-xs text-blue-100 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span> Online
                    </p>
                </div>
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 overflow-y-auto p-4 bg-gray-50/50 space-y-4" id="chatMessages">
            
            <!-- Quick Replies (Show only if no messages yet or optional) -->
            <div x-show="messages.length === 1" class="mb-4">
                <p class="text-xs text-gray-500 mb-2 px-1">Gợi ý cho bạn:</p>
                <div class="flex flex-wrap gap-2">
                    <button @click="inputMessage = 'Shop đang có khuyến mãi gì không?'; sendMessage()" class="text-xs bg-white border border-purple-100 text-purple-600 px-3 py-1.5 rounded-full hover:bg-purple-50 transition shadow-sm">
                        🎁 Khuyến mãi hot
                    </button>
                    <button @click="inputMessage = 'Gợi ý sản phẩm mới nhất'; sendMessage()" class="text-xs bg-white border border-blue-100 text-blue-600 px-3 py-1.5 rounded-full hover:bg-blue-50 transition shadow-sm">
                        👕 Sản phẩm mới
                    </button>
                    <button @click="inputMessage = 'Chính sách đổi trả thế nào?'; sendMessage()" class="text-xs bg-white border border-orange-100 text-orange-600 px-3 py-1.5 rounded-full hover:bg-orange-50 transition shadow-sm">
                        🚚 Đổi trả & Ship
                    </button>
                </div>
            </div>

            <template x-for="msg in messages" :key="msg.id">
                <div class="flex items-start gap-2.5" :class="{'flex-row-reverse': msg.isUser}">
                    <template x-if="!msg.isUser">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-600 to-blue-600 flex items-center justify-center flex-shrink-0 text-white text-xs">
                            <i class="fa-solid fa-robot"></i>
                        </div>
                    </template>
                    <div class="p-3 rounded-2xl shadow-sm text-sm max-w-[75%] break-words"
                         :class="msg.isUser ? 'bg-purple-600 text-white rounded-tr-none' : 'bg-white text-gray-700 rounded-tl-none border border-gray-100'">
                        <p x-text="msg.text" class="whitespace-pre-line leading-relaxed"></p>
                    </div>
                </div>
                
                <!-- Dynamic Suggestions for Bot Messages -->
                <template x-if="!msg.isUser && msg.suggestions && msg.suggestions.length > 0">
                    <div class="flex flex-wrap gap-2 ml-10 mb-2">
                        <template x-for="suggestion in msg.suggestions" :key="suggestion">
                            <button @click="inputMessage = suggestion; sendMessage()" 
                                    class="text-xs bg-white border border-purple-100 text-purple-600 px-3 py-1.5 rounded-full hover:bg-purple-50 transition shadow-sm whitespace-nowrap">
                                <span x-text="suggestion"></span>
                            </button>
                        </template>
                    </div>
                </template>
            </template>
            
            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex items-start gap-2.5">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-600 to-blue-600 flex items-center justify-center flex-shrink-0 text-white text-xs">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm border border-gray-100 w-16">
                    <div class="flex gap-1 justify-center">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></span>
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-3 bg-white border-t border-gray-100 flex-shrink-0">
            <form @submit.prevent="sendMessage" class="flex items-center gap-2">
                <input type="text" 
                       x-model="inputMessage" 
                       placeholder="Nhập tin nhắn..." 
                       class="flex-1 px-4 py-2.5 bg-gray-100 rounded-full text-sm border-transparent focus:bg-white focus:border-purple-500 focus:ring-0 transition"
                       :disabled="isTyping">
                <button type="submit" 
                        class="p-2.5 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-full hover:shadow-lg hover:scale-105 transition transform disabled:opacity-50 disabled:cursor-not-allowed flex-shrink-0"
                        :disabled="!inputMessage.trim() || isTyping">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Toggle Button -->
    <button @click="toggleChat()" 
            class="w-14 h-14 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition transform hover:scale-105 relative z-[10000]">
        <!-- Icons -->
        <i class="fa-solid fa-comment-dots text-white text-2xl transition duration-300 absolute" 
           :class="{'opacity-0 rotate-90': isOpen, 'opacity-100 rotate-0': !isOpen}"></i>
        <i class="fa-solid fa-xmark text-white text-xl transition duration-300 absolute" 
           :class="{'opacity-100 rotate-0': isOpen, 'opacity-0 -rotate-90': !isOpen}"></i>
        
        <!-- Notification Dot -->
        <span x-show="!isOpen && hasNewMessage" 
              class="absolute top-0 right-0 w-4 h-4 bg-red-500 border-2 border-white rounded-full animate-pulse"></span>
    </button>
</div>
