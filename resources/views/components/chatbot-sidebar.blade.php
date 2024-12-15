<!-- resources/views/components/chatbot-sidebar.blade.php -->
<div id="chatbot-sidebar" class="fixed right-0 top-0 w-80 h-full bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="h-full flex flex-col">
        <div class="bg-indigo-600 text-white p-4 flex justify-between items-center">
            <h3 class="text-lg font-semibold">TaskMaster AI Assistant</h3>
            <button id="close-chatbot" class="text-white hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div id="chatbot-messages" class="flex-grow overflow-y-auto p-4 space-y-4">
            <div class="text-center text-gray-500 mt-4">
                Start a conversation with your AI assistant
            </div>
        </div>
        
        <div class="p-4 border-t">
            <form id="chatbot-form" class="flex space-x-2">
                <input 
                    type="text" 
                    id="chatbot-input" 
                    placeholder="Ask me anything about your tasks..." 
                    class="flex-grow px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <button 
                    type="submit" 
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition"
                >
                    Send
                </button>
            </form>
        </div>
    </div>
</div>

<button 
    id="open-chatbot" 
    class="fixed bottom-4 right-4 bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 transition z-40"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
    </svg>
</button>