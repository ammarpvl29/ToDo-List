document.addEventListener('DOMContentLoaded', function() {
    // Ensure all elements exist before attaching event listeners
    const openChatbot = document.getElementById('open-chatbot');
    const closeChatbot = document.getElementById('close-chatbot');
    const chatbotSidebar = document.getElementById('chatbot-sidebar');

    // Debug logging
    console.log('Open Chatbot Button:', openChatbot);
    console.log('Close Chatbot Button:', closeChatbot);
    console.log('Chatbot Sidebar:', chatbotSidebar);

    // Attach event listeners only if elements exist
    if (openChatbot && chatbotSidebar) {
        openChatbot.addEventListener('click', function(e) {
            console.log('Open chatbot clicked');
            e.preventDefault(); // Prevent any default behavior
            chatbotSidebar.classList.remove('translate-x-full');
            chatbotSidebar.classList.add('translate-x-0');
        });
    } else {
        console.warn('Chatbot open button or sidebar not found');
    }

    if (closeChatbot && chatbotSidebar) {
        closeChatbot.addEventListener('click', function(e) {
            console.log('Close chatbot clicked');
            e.preventDefault(); // Prevent any default behavior
            chatbotSidebar.classList.remove('translate-x-0');
            chatbotSidebar.classList.add('translate-x-full');
        });
    } else {
        console.warn('Chatbot close button not found');
    }
    const chatbotForm = document.getElementById('chatbot-form');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotMessages = document.getElementById('chatbot-messages');

    // Toggle chatbot sidebar
    openChatbot.addEventListener('click', function() {
        chatbotSidebar.classList.remove('translate-x-full');
        chatbotSidebar.classList.add('translate-x-0');
    });

    closeChatbot.addEventListener('click', function() {
        chatbotSidebar.classList.remove('translate-x-0');
        chatbotSidebar.classList.add('translate-x-full');
    });

    // Function to add messages to the chat
    function addMessage(message, type) {
        const messageContainer = document.createElement('div');
        messageContainer.classList.add('message', 'p-3', 'rounded-lg', 'max-w-[80%]');
        
        if (type === 'user') {
            messageContainer.classList.add('bg-indigo-100', 'text-indigo-800', 'self-end', 'ml-auto');
        } else if (type === 'ai') {
            messageContainer.classList.add('bg-gray-100', 'text-gray-800', 'self-start', 'mr-auto');
        }
        
        messageContainer.textContent = message;
        chatbotMessages.appendChild(messageContainer);
        
        // Scroll to bottom
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    // Handle form submission
    chatbotForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const userMessage = chatbotInput.value.trim();
        
        if (userMessage) {
            // Add user message to chat
            addMessage(userMessage, 'user');
            
            // Clear input
            chatbotInput.value = '';
            
            // Show loading indicator
            const loadingMessage = document.createElement('div');
            loadingMessage.classList.add('message', 'bg-gray-100', 'text-gray-800', 'self-start', 'mr-auto', 'p-3', 'rounded-lg');
            loadingMessage.innerHTML = '<span class="animate-pulse">AI is thinking...</span>';
            chatbotMessages.appendChild(loadingMessage);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

            // Send message to backend
            fetch('/chatbot/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ 
                    message: userMessage,
                    context: 'todo-list' // Optional: provide context for more relevant responses
                })
            })
            .then(response => {
                // Remove loading message
                chatbotMessages.removeChild(loadingMessage);
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Add AI response to chat
                addMessage(data.message || 'Sorry, I could not process your request.', 'ai');
            })
            .catch(error => {
                console.error('Chatbot Error:', error);
                
                // Remove loading message
                if (loadingMessage.parentNode === chatbotMessages) {
                    chatbotMessages.removeChild(loadingMessage);
                }
                
                // Add error message
                addMessage('Sorry, there was an error processing your request.', 'ai');
            });
        }
    });

    // Allow sending message by pressing Enter
    chatbotInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            chatbotForm.dispatchEvent(new Event('submit'));
        }
    });

    // Optional: Initial welcome message
    function showWelcomeMessage() {
        const welcomeMessages = [
            "Hi there! I'm your AI Task Assistant. Need help organizing your todos?",
            "Welcome! I can help you prioritize tasks, break down complex projects, or offer productivity tips.",
            "Hello! Let me know how I can help you manage your tasks more effectively."
        ];

        const randomWelcome = welcomeMessages[Math.floor(Math.random() * welcomeMessages.length)];
        addMessage(randomWelcome, 'ai');
    }

    // Show welcome message when sidebar is first opened
    openChatbot.addEventListener('click', function() {
        if (chatbotMessages.children.length === 0) {
            showWelcomeMessage();
        }
    }, { once: true });
});