<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Chat Real-Time</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body { font-family: sans-serif; background: #f0f2f5; height: 100vh; display: flex; flex-direction: column; }
            header { background: #4f46e5; color: white; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; }
            #chat-box { flex: 1; overflow-y: auto; padding: 24px; display: flex; flex-direction: column; gap: 12px; }
            .msg { max-width: 60%; padding: 10px 14px; border-radius: 16px; font-size: 14px; line-height: 1.5; }
            .msg .name { font-size: 11px; font-weight: 600; margin-bottom: 4px; color: #555; }
            .msg .time { font-size: 10px; color: #999; text-align: right; margin-top: 4px; }
            .msg.mine { align-self: flex-end; background: #4f46e5; color: white; }
            .msg.mine .name, .msg.mine .time { color: #c7d2fe; }
            .msg.other { align-self: flex-start; background: white; color: #1f2937; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
            #input-area { background: white; padding: 16px 24px; display: flex; gap: 12px; border-top: 1px solid #e5e7eb; }
            #input-area input { flex: 1; padding: 10px 16px; border: 1px solid #d1d5db; border-radius: 24px; outline: none; font-size: 14px; }
            #input-area input:focus { border-color: #4f46e5; }
            #input-area button { background: #4f46e5; color: white; border: none; padding: 10px 20px; border-radius: 24px; cursor: pointer; font-size: 14px; }
            #input-area button:hover { background: #4338ca; }
        </style>
    </head>

    <body>
        <header>
            <span>💬 Chat Real-Time</span>
            <span>{{ auth()->user()->name }} &nbsp;|&nbsp;
                <a href="{{ route('logout') }}" style="color:#c7d2fe"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
            </span>
        </header>

        <div id="chat-box">
            @foreach($messages as $msg)
                <div class="msg {{ $msg->user_id === auth()->id() ? 'mine' : 'other' }}">
                    <div class="name">{{ $msg->user->name }}</div>
                    <div>{{ $msg->body }}</div>
                    <div class="time">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            @endforeach
        </div>

        <div id="input-area">
            <input type="text" id="message-input" placeholder="Ketik pesan..." autocomplete="off">
            <button id="send-btn">Kirim</button>
        </div>

        <script>
            const chatBox = document.getElementById('chat-box');
            const input = document.getElementById('message-input');
            const sendBtn = document.getElementById('send-btn');

            chatBox.scrollTop = chatBox.scrollHeight;

            function appendMessage(data, isMine) {
                const div = document.createElement('div');
                div.className = 'msg ' + (isMine ? 'mine' : 'other');
                div.innerHTML = `
                    <div class="name">${data.user}</div>
                    <div>${data.body}</div>
                    <div class="time">${data.created_at}</div>
                `;
                chatBox.appendChild(div);
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            async function sendMessage() {
                const body = input.value.trim();
                if (!body) return;
                input.value = '';

                const res = await fetch('{{ route('chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Socket-ID': window.Echo.socketId(),
                    },
                    body: JSON.stringify({ body }),
                });

                const data = await res.json();
                appendMessage(data, true);
            }

            sendBtn.addEventListener('click', sendMessage);
            input.addEventListener('keydown', e => { if (e.key === 'Enter') sendMessage(); });

            function initEcho() {
                if (window.Echo) {
                    window.Echo.channel('chat').listen('.message.sent', (e) => {
                        appendMessage(e, false);
                    });
                } else {
                    setTimeout(initEcho, 500);
                }
            }
            initEcho();
        </script>
    </body>
</html>