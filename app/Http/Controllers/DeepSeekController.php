<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DeepSeekController extends Controller
{
    public function chat()
    {
        return view('chat');
    }

    public function query(Request $request)
    {
        $request->validate([
            'user_input' => 'required|string|max:1000',
        ]);

        try {
            $userInput = $request->input('user_input');

            $response = Http::timeout(300)->post('http://localhost:11434/api/chat', [
                'model' => 'deepseek-r1',
                'messages' => [
                    ['role' => 'user', 'content' => $userInput],
                ],
                'stream' => false,
            ]);
            $data = $response->json();
            // $reply = $data['message']['content'] ?? 'No response received.';
            $reply = $data['message']['content'] ?? 'No reply received';
        } catch (\Exception $e) {
            $reply = 'An error occurred: ' . $e->getMessage();
        }

        return response()->json(['reply' => $reply]);
    }
}
