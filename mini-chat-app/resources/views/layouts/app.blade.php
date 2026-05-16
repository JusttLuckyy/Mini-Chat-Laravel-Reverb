<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
        @keyframes typingBounce {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-5px); }
        }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow" style="padding-left: 72px;">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main style="padding-left: 72px;">
                {{ $slot }}
            </main>
        </div>

        {{-- SIDEBAR KIRI --}}
        <div id="right-sidebar" style="position:fixed;top:0;left:0;height:100vh;width:60px;background:#1e293b;display:flex;flex-direction:column;align-items:center;padding:16px 0;gap:8px;z-index:1000;">
            
            {{-- Logo / Home --}}
            <a href="{{ url('/dashboard') }}" style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.4);text-decoration:none;margin-bottom:8px;" title="Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
            </a>

            <div style="width:32px;height:1px;background:rgba(255,255,255,0.08);margin:4px 0;"></div>

            {{-- Tombol Chat --}}
            <button onclick="toggleChat()" title="Chat" style="position:relative;width:36px;height:36px;background:#0078D4;border-radius:8px;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#E8EDF2e;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="18" height="18"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" /></svg>
                <span id="chat-badge" style="display:none;position:absolute;top:-4px;right:-4px;background:#ef4444;color:white;border-radius:50%;width:16px;height:16px;font-size:9px;font-weight:700;align-items:center;justify-content:center;">0</span>
            </button>

            {{-- Settings --}}
            <a href="{{ url('/profile') }}" style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.4);text-decoration:none;" title="Profile">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">
                @csrf
                <button type="submit" title="Logout"
                    style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,0.4);background:none;border:none;cursor:pointer;"
                    onmouseover="this.style.background='rgba(239,68,68,0.2)';this.style.color='#ef4444'"
                    onmouseout="this.style.background='none';this.style.color='rgba(255,255,255,0.4)'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                </button>
            </form>

            {{-- Avatar User --}}
            <div style="width:32px;height:32px;background:#334155;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;color:rgba(255,255,255,0.7);font-weight:500;margin-bottom:8px;" title="{{ auth()->user()->name }}">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        </div>

        {{-- CHAT POPUP --}}
        <div id="chat-popup" style="display:none;position:fixed;bottom:20px;left:72px;width:320px;height:460px;background:white;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.15);z-index:999;flex-direction:column;overflow:hidden;border:0.5px solid #e2e8f0;">
            <div style="background:#0078D4;padding:12px 16px;display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <p style="color:white;font-size:14px;font-weight:500;margin:0;">💬 Chat Real-Time</p>
                    <p style="color:rgba(255,255,255,0.7);font-size:11px;margin:0;">{{ auth()->user()->name }}</p>
                </div>
                <div style="display:flex;align-items:center;gap:8px;">
                    {{-- Indikator online --}}
                    <div style="display:flex;align-items:center;gap:4px;">
                        <div style="width:7px;height:7px;background:#4ade80;border-radius:50%;"></div>
                        <span id="online-count" style="color:rgba(255,255,255,0.8);font-size:11px;">1 online</span>
                    </div>
                    <button onclick="toggleChat()" style="background:rgba(255,255,255,0.15);border:none;border-radius:6px;width:28px;height:28px;cursor:pointer;color:white;display:flex;align-items:center;justify-content:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="14" height="14"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
            <div id="chat-messages" style="flex:1;overflow-y:auto;padding:12px;display:flex;flex-direction:column;gap:8px;background:#f8fafc;"></div>
            {{-- Typing Indicator --}}
            <div id="typing-indicator" style="display:none;padding:4px 12px 8px;background:#f8fafc;">
                <div style="display:flex;flex-direction:column;gap:3px;align-self:flex-start;">
                    <span id="typing-name" style="font-size:10px;color:#94a3b8;padding-left:4px;"></span>
                    <div style="background:white;border:0.5px solid #e2e8f0;border-radius:0 12px 12px 12px;padding:10px 14px;display:inline-flex;gap:4px;align-items:center;width:fit-content;">
                        <div style="width:6px;height:6px;background:#0078D4;border-radius:50%;animation:typingBounce 1.2s infinite;opacity:0.7;"></div>
                        <div style="width:6px;height:6px;background:#0078D4;border-radius:50%;animation:typingBounce 1.2s infinite 0.2s;opacity:0.7;"></div>
                        <div style="width:6px;height:6px;background:#0078D4;border-radius:50%;animation:typingBounce 1.2s infinite 0.4s;opacity:0.7;"></div>
                    </div>
                </div>
            </div>
            <div style="padding:10px 12px;border-top:1px solid #f1f5f9;background:white;display:flex;gap:8px;">
                <input id="chat-input" type="text" placeholder="Ketik pesan..." autocomplete="off"
                    style="flex:1;padding:8px 14px;border:1px solid #e2e8f0;border-radius:20px;font-size:13px;outline:none;">
                <button onclick="sendChat()" style="width:36px;height:36px;background:#0078D4;border:none;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;color:white;flex-shrink:0;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" /></svg>
                </button>
            </div>
        </div>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            const currentUser = @json(auth()->user()->name);
            let chatOpen = false;
            let unreadCount = 0;
            let onlineCount = 1;

            function toggleChat() {
                chatOpen = !chatOpen;
                const popup = document.getElementById('chat-popup');
                popup.style.display = chatOpen ? 'flex' : 'none';
                if (chatOpen) {
                    unreadCount = 0;
                    updateBadge();
                    loadMessages();
                    setTimeout(() => document.getElementById('chat-input').focus(), 100);
                }
            }

            function updateBadge() {
                const badge = document.getElementById('chat-badge');
                if (unreadCount > 0) {
                    badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            }

            function updateOnlineCount(total, delta) {
                if (total !== null) {
                    onlineCount = total;
                } else {
                    onlineCount = Math.max(0, onlineCount + delta);
                }
                const el = document.getElementById('online-count');
                const dot = el ? el.previousElementSibling : null;
                if (el) {
                    if (onlineCount > 1) {
                        el.textContent = 'Online';
                        if (dot) dot.style.background = '#4ade80'; // hijau
                    } else {
                        el.textContent = 'Offline';
                        if (dot) dot.style.background = '#94a3b8'; // abu-abu
                    }
                }
            }

            function appendMsg(data, isMine) {
                const box = document.getElementById('chat-messages');
                const time = data.created_at || new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});

                const wrapper = document.createElement('div');
                wrapper.style.cssText = `display:flex;justify-content:${isMine ? 'flex-end' : 'flex-start'};margin-bottom:4px;`;

                wrapper.innerHTML = `
                    <div style="
                        position:relative;
                        max-width:75%;
                        padding:8px 12px;
                        border-radius:${isMine ? '12px 0 12px 12px' : '0 12px 12px 12px'};
                        background:${isMine ? '#0078D4' : 'white'};
                        color:${isMine ? 'white' : '#1e293b'};
                        ${!isMine ? 'border:0.5px solid #e2e8f0;' : ''}
                        word-break:break-word;
                        box-shadow:0 1px 2px rgba(0,0,0,0.08);
                    ">
                        <!-- Ekor bubble -->
                        <div style="
                            position:absolute;
                            top:0;
                            ${isMine ? 'right:-7px' : 'left:-7px'};
                            width:0;height:0;
                            border-style:solid;
                            border-width:${isMine ? '0 0 8px 8px' : '0 8px 8px 0'};
                            border-color:${isMine
                                ? 'transparent transparent transparent #0078D4'
                                : 'transparent #e2e8f0 transparent transparent'};
                        "></div>
                        ${!isMine ? `<div style="
                            position:absolute;top:1px;left:-6px;
                            width:0;height:0;border-style:solid;
                            border-width:0 7px 7px 0;
                            border-color:transparent white transparent transparent;
                        "></div>` : ''}
                        <div style="display:flex;align-items:flex-end;gap:8px;">
                            <span style="font-size:13px;flex:1;">${data.body}</span>
                            <span style="font-size:10px;opacity:0.6;white-space:nowrap;margin-top:4px;">${time}</span>
                        </div>
                    </div>
                `;

                box.appendChild(wrapper);
                box.scrollTop = box.scrollHeight;
            }

            async function loadMessages() {
                const box = document.getElementById('chat-messages');
                box.innerHTML = '';
                const res = await fetch('/chat/messages', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                const msgs = await res.json();
                msgs.forEach(m => appendMsg(m, m.user === currentUser));
            }

            async function sendChat() {
                const input = document.getElementById('chat-input');
                const body = input.value.trim();
                if (!body) return;
                input.value = '';
                const res = await fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Socket-ID': window.Echo ? window.Echo.socketId() : '',
                    },
                    body: JSON.stringify({ body }),
                });
                const data = await res.json();
                appendMsg(data, true);
            }

            document.addEventListener('DOMContentLoaded', () => {
                const input = document.getElementById('chat-input');
                if (input) {
                    input.addEventListener('keydown', e => { if (e.key === 'Enter') sendChat(); });
                    input.addEventListener('input', () => {
                        if (window.Echo) {
                            window.Echo.join('chat.presence').whisper('typing', {
                                name: currentUser,
                            });
                        }
                    });
                }
            });

            let typingTimeout;

            function showTyping(name) {
                const indicator = document.getElementById('typing-indicator');
                const typingName = document.getElementById('typing-name');
                if (indicator && typingName) {
                    typingName.textContent = '';
                    indicator.style.display = 'block';
                    clearTimeout(typingTimeout);
                    typingTimeout = setTimeout(hideTyping, 2000);
                }
            }

            function hideTyping() {
                const indicator = document.getElementById('typing-indicator');
                if (indicator) indicator.style.display = 'none';
            }

            function initEcho() {
                if (window.Echo) {
                    window.Echo.join('chat.presence')
                        .here((users) => {
                            updateOnlineCount(users.length, null);
                        })
                        .joining((user) => {
                            updateOnlineCount(null, 1);
                        })
                        .leaving((user) => {
                            updateOnlineCount(null, -1);
                        })
                        .listenForWhisper('typing', (e) => {
                            showTyping(e.name);
                        });

                    window.Echo.channel('chat').listen('.message.sent', (e) => {
                        if (!chatOpen) { unreadCount++; updateBadge(); }
                        appendMsg(e, e.user === currentUser);
                        hideTyping();
                    });
                } else {
                    setTimeout(initEcho, 500);
                }
            }
            initEcho();
        </script>
    </body>
</html>
