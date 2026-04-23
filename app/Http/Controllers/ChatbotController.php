<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

interface ChatbotBackendInterface
{
    public function getReply(string $message): string;
}

class BingChatbotBackend implements ChatbotBackendInterface
{
    public function getReply(string $message): string
    {
        $apiKey = env('BING_API_KEY');
        $endpoint = env('BING_API_ENDPOINT');
        if (!$apiKey || !$endpoint) {
            Log::error('Bing API key or endpoint not configured');
            return 'I\'m experiencing some technical difficulties right now. Please try again later.';
        }

        $payload = [
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful fitness coach AI for gym members. Keep responses concise and focused on fitness advice.'
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'max_tokens' => 300,
            'temperature' => 0.7,
        ];

        Log::info('Sending request to Bing Chat API', ['payload' => $payload]);

        $response = Http::withHeaders([
            'api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post($endpoint, $payload);

        Log::info('Bing Chat API raw response', ['status' => $response->status(), 'body' => $response->body()]);

        if ($response->successful()) {
            $data = $response->json();
            // Adapt response parsing based on Bing API response structure
            if (isset($data['choices'][0]['message']['content'])) {
                return $data['choices'][0]['message']['content'];
            } else {
                Log::error('Unexpected Bing Chat API response structure', ['response_data' => $data]);
                return 'Sorry, I couldn\'t generate a response right now.';
            }
        } else {
            $errorData = $response->json();
            Log::error('Bing Chat API error', ['status' => $response->status(), 'body' => $response->body(), 'error_data' => $errorData]);

            if ($response->status() === 429) {
                return 'I\'m currently receiving too many requests. Please try again in a moment.';
            } elseif ($response->status() === 403) {
                return 'There seems to be an issue with my configuration. Please contact support.';
            } else {
                return 'I\'m experiencing some technical difficulties right now. Please try again later.';
            }
        }
    }
}

class ChatbotController extends Controller
{
    protected $backend;

    public function __construct(Request $request)
    {
        // Only Bing Chat backend is used now
        $this->backend = new BingChatbotBackend();
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $request->input('message');

        Log::info('Chatbot request received', ['message' => $message, 'backend' => get_class($this->backend)]);
        try {
            $reply = $this->backend->getReply($message);
            Log::info('Chatbot response generated', ['reply' => $reply]);
            return response()->json(['reply' => $reply]);
        } catch (\Exception $e) {
            Log::error('Chatbot exception caught', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['reply' => 'I\'m experiencing some technical difficulties right now. Please try again later.']);
        }
    }
}
