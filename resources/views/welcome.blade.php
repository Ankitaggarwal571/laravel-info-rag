<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel AI Assistant</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        laravel: '#ff2d20',
                    }
                }
            }
        }
    </script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <!-- Phosphor Icons for crisp, modern icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="flex h-screen overflow-hidden antialiased text-gray-200">

    <!-- Left Sidebar -->
    <aside class="sidebar w-64 flex flex-col hidden md:flex h-full">
        <!-- New Chat Button -->
        <div class="p-4">
            <button class="flex items-center gap-2 w-full p-3 rounded-lg border border-gray-600 hover:bg-gray-800 transition-colors duration-200">
                <i class="ph ph-plus font-bold"></i>
                <span class="text-sm font-medium">New Chat</span>
            </button>
        </div>

        <!-- Chat History -->
        <div class="flex-1 overflow-y-auto px-4 py-2 space-y-2">
            <div class="text-xs font-semibold text-gray-500 mb-2 mt-4 px-2">Today</div>
            <a href="#" class="sidebar-item flex items-center gap-2 p-3 rounded-lg text-sm text-gray-300">
                <i class="ph ph-chat-teardrop-text text-lg"></i>
                <span class="truncate">Eloquent Relationships explained</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-2 p-3 rounded-lg text-sm text-gray-300">
                <i class="ph ph-chat-teardrop-text text-lg"></i>
                <span class="truncate">Setting up Laravel Redis queues</span>
            </a>

            <div class="text-xs font-semibold text-gray-500 mb-2 mt-6 px-2">Previous 7 Days</div>
            <a href="#" class="sidebar-item flex items-center gap-2 p-3 rounded-lg text-sm text-gray-300">
                <i class="ph ph-chat-teardrop-text text-lg"></i>
                <span class="truncate">Tailwind setup in Laravel</span>
            </a>
            <a href="#" class="sidebar-item flex items-center gap-2 p-3 rounded-lg text-sm text-gray-300">
                <i class="ph ph-chat-teardrop-text text-lg"></i>
                <span class="truncate">Docker config for Postgres</span>
            </a>
        </div>

        <!-- User Profile Area -->
        <div class="p-4 border-t border-gray-800">
            <button class="flex items-center gap-3 w-full p-2 rounded-lg hover:bg-gray-800 transition-colors duration-200">
                <div class="w-8 h-8 rounded-full bg-gray-600 flex items-center justify-center font-bold text-sm text-white">
                    U
                </div>
                <span class="text-sm font-medium">Laravel User</span>
                <i class="ph ph-dots-three ml-auto text-xl text-gray-400"></i>
            </button>
        </div>
    </aside>

    <!-- Main Chat Area -->
    <main class="flex-1 flex flex-col chat-container h-full relative">
        
        <!-- Mobile Header -->
        <header class="md:hidden flex items-center justify-between p-4 border-b border-gray-800 bg-[#111]">
            <button class="text-gray-300 hover:text-white">
                <i class="ph ph-list text-2xl"></i>
            </button>
            <span class="font-medium">Laravel Assistant</span>
            <button class="text-gray-300 hover:text-white">
                <i class="ph ph-plus text-2xl"></i>
            </button>
        </header>

        <!-- Messages Container -->
        <div class="flex-1 overflow-y-auto w-full scroll-smooth">
            
            <!-- Welcome Screen (Visible when no messages) -->
            <!-- <div class="h-full flex flex-col items-center justify-center text-center px-4">
                <div class="w-16 h-16 bg-laravel/10 rounded-full flex items-center justify-center mb-6 laravel-glow">
                    <svg class="w-10 h-10 text-laravel" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                </div>
                <h1 class="text-3xl font-semibold mb-2">How can I help you with Laravel?</h1>
                <p class="text-gray-400 mb-8">Ask me anything about Eloquent, routing, artisan commands, or architecture.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full max-w-2xl">
                    <button class="p-4 border border-gray-700 rounded-xl hover:bg-gray-800 text-left transition-colors">
                        <div class="font-medium text-sm">Explain Eloquent eager loading</div>
                        <div class="text-xs text-gray-500 mt-1">Provide examples and performance benefits</div>
                    </button>
                    <button class="p-4 border border-gray-700 rounded-xl hover:bg-gray-800 text-left transition-colors">
                        <div class="font-medium text-sm">How to create a custom Artisan command?</div>
                        <div class="text-xs text-gray-500 mt-1">Walk me through the steps in Laravel</div>
                    </button>
                </div>
            </div> -->

            <!-- Active Chat State -->
            <div class="w-full max-w-3xl mx-auto py-8 px-4 flex flex-col gap-6">
                
                <!-- User Message -->
                <div class="flex gap-4 message-user p-4 rounded-xl">
                    <div class="w-8 h-8 rounded bg-gray-600 flex-shrink-0 flex items-center justify-center font-bold text-sm text-white mt-1">
                        U
                    </div>
                    <div class="flex-1 space-y-2">
                        <div class="font-semibold text-gray-300">You</div>
                        <div class="text-gray-100 leading-relaxed">
                            How do I set up a job queue in Laravel using Redis?
                        </div>
                    </div>
                </div>

                <!-- Bot Message -->
                <div class="flex gap-4 message-bot p-4 rounded-xl shadow-sm">
                    <div class="w-8 h-8 rounded bg-laravel/20 flex-shrink-0 flex items-center justify-center text-laravel mt-1">
                        <svg class="w-5 h-5 laravel-glow" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div class="flex-1 space-y-2">
                        <div class="font-semibold text-laravel">Laravel Assistant</div>
                        <div class="text-gray-200 leading-relaxed space-y-4">
                            <p>Setting up a job queue in Laravel with Redis is straightforward. First, make sure you have Redis installed and the `predis/predis` or `phpredis` extension configured.</p>
                            
                            <p>1. Update your `.env` file to use the Redis queue driver:</p>
                            <pre class="bg-[#111] p-4 rounded-lg overflow-x-auto text-sm text-gray-300 font-mono">QUEUE_CONNECTION=redis</pre>
                            
                            <p>2. Create a new job using Artisan:</p>
                            <pre class="bg-[#111] p-4 rounded-lg overflow-x-auto text-sm text-gray-300 font-mono">php artisan make:job ProcessPodcast</pre>

                            <p>3. Dispatch the job in your controller:</p>
                            <pre class="bg-[#111] p-4 rounded-lg overflow-x-auto text-sm text-gray-300 font-mono">ProcessPodcast::dispatch($podcast);</pre>

                            <p>4. Run the queue worker to process jobs:</p>
                            <pre class="bg-[#111] p-4 rounded-lg overflow-x-auto text-sm text-gray-300 font-mono">php artisan queue:work</pre>
                        </div>
                        <div class="flex items-center gap-3 mt-4 pt-2 text-gray-500">
                            <button class="hover:text-gray-300 transition-colors"><i class="ph ph-copy text-lg"></i></button>
                            <button class="hover:text-gray-300 transition-colors"><i class="ph ph-thumbs-up text-lg"></i></button>
                            <button class="hover:text-gray-300 transition-colors"><i class="ph ph-thumbs-down text-lg"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Simulating Typing (Optional Demo) -->
                <!--
                <div class="flex gap-4 p-4 rounded-xl">
                    <div class="w-8 h-8 rounded bg-laravel/20 flex-shrink-0 flex items-center justify-center text-laravel mt-1">
                        <svg class="w-5 h-5 laravel-glow" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div class="flex-1 py-3">
                        <div class="dot-flashing"></div>
                    </div>
                </div>
                -->

            </div>
            <!-- Spacer for bottom input -->
            <div class="h-40 w-full"></div>
        </div>

        <!-- Input Area Fixed at Bottom -->
        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-[#1a1a1a] via-[#1a1a1a] to-transparent pt-10 pb-6 px-4">
            <div class="max-w-3xl mx-auto">
                <div class="input-wrapper rounded-2xl p-2 px-4 shadow-lg flex items-end gap-2 bg-[#2a2a2a] relative">
                    <button class="p-2 text-gray-400 hover:text-white transition-colors pb-3">
                        <i class="ph ph-paperclip text-xl"></i>
                    </button>
                    <textarea 
                        rows="1" 
                        class="chat-input flex-1 py-3 bg-transparent text-sm"
                        placeholder="Message Laravel Assistant..."
                        oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"
                    ></textarea>
                    <button class="btn-primary w-10 h-10 rounded-xl flex items-center justify-center text-white mb-1 shrink-0 shadow">
                        <i class="ph ph-paper-plane-right text-lg"></i>
                    </button>
                </div>
                <div class="text-center text-xs text-gray-500 mt-3">
                    Laravel AI Assistant can make mistakes. Consider verifying critical code.
                </div>
            </div>
        </div>

    </main>

</body>
</html>
