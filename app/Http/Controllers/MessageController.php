<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\NewMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();

        return response()->json(['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $message = Message::create([
            'user_id' => Auth::id(),
            'recipient_id' => $request->recipientId,
            'text' => $request->text,
        ]);
    
        event(new NewMessage($message));
    
        return response()->json(['message' => $message], 201);
    }
}

