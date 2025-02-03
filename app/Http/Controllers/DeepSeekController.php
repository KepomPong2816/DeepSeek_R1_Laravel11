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

            if ($response->failed()) {
                return back()->withErrors(['error' => 'Failed to connect to DeepSeek API.']);
            }

            $data = $response->json();
            $reply = $data['message']['content'] ?? 'No response received.';

        } catch (\Exception $e) {
            Log::error('DeepSeek API Error: ' . $e->getMessage());
            return back()->withErrors(['error' => $e . 'An error occurred while processing your request.']);
        }

        return view('chat', ['reply' => $reply, 'user_input' => $userInput]);
    }
}
