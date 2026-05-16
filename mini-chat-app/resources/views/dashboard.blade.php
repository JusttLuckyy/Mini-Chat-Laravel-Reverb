<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">

            {{-- Banner Card --}}
            <div style="background:linear-gradient(135deg, #0078D4, #005a9e);border-radius:12px;padding:24px 28px;display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <div style="display:flex;align-items:center;gap:8px;margin:0 0 4px;">
                        <p style="color:rgba(255,255,255,0.7);font-size:13px;margin:0;">Tugas Praktikum</p>
                        <span style="color:rgba(255,255,255,0.3);font-size:13px;">·</span>
                        <p style="color:rgba(255,255,255,0.5);font-size:13px;margin:0;">Pemrograman Berbasis Web</p>
                    </div>
                    <h1 style="color:white;font-size:22px;font-weight:700;margin:0 0 6px;">💬 Mini Chat Real-Time</h1>
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span style="background:rgba(255,255,255,0.15);color:white;font-size:11px;padding:3px 10px;border-radius:20px;">Laravel</span>
                        <span style="background:rgba(255,255,255,0.15);color:white;font-size:11px;padding:3px 10px;border-radius:20px;">Reverb</span>
                        <span style="background:rgba(255,255,255,0.15);color:white;font-size:11px;padding:3px 10px;border-radius:20px;">WebSocket</span>
                    </div>
                </div>
                <div style="font-size:56px;opacity:0.3;">💬</div>
            </div>

            {{-- Card Logged In --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    You're logged in as <strong>{{ auth()->user()->name }}</strong>!
                </div>
            </div>

        </div>
    </div>
</x-app-layout>