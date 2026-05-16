<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        return view('chat', compact('messages'));
    }

    public function send(Request $request)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        $message = Message::create([
            'user_id' => auth()->id(),
            'body'    => $request->body,
        ]);

        $message->load('user');

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'id'         => $message->id,
            'body'       => $message->body,
            'user'       => $message->user->name,
            'created_at' => $message->created_at->format('H:i'),
        ]);
    }

    public function messages()
    {
        $messages = Message::with('user')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values()
            ->map(fn($m) => [
                'id'         => $m->id,
                'body'       => $m->body,
                'user'       => $m->user->name,
                'created_at' => $m->created_at->format('H:i'),
            ]);

        return response()->json($messages);
    }
}