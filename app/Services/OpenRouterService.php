<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class OpenRouterService
{
    private $apiKey;
    private $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openrouter.key');
    }

    public function generateResponse($prompt)
    {
        try {
            // Extensive logging for debugging
            Log::channel('openrouter')->info('OpenRouter Request', [
                'prompt' => $prompt,
                'api_key' => $this->apiKey ? 'Key Present' : 'No Key',
                'base_url' => $this->baseUrl
            ]);

            // Validate API key
            if (!$this->apiKey) {
                Log::channel('openrouter')->error('Missing OpenRouter API Key');
                return "API configuration error: No API key found.";
            }

            // Make the HTTP request with detailed error handling
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name')
            ])->timeout(30) // Increased timeout
              ->connectTimeout(10)
              ->post($this->baseUrl, [
                'model' => 'microsoft/phi-3-mini-128k-instruct:free',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a helpful AI assistant for a todo list application. Keep responses concise and task-oriented.'
                    ],
                    [
                        'role' => 'user', 
                        'content' => $prompt
                    ]
                ],
                'max_tokens' => 150 // Limit response length
            ]);

            // Log full response for debugging
            Log::channel('openrouter')->info('OpenRouter Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            // Detailed error checking
            if (!$response->successful()) {
                Log::channel('openrouter')->error('OpenRouter API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return match($response->status()) {
                    401 => "Authentication failed. Please check your API key.",
                    429 => "Rate limit exceeded. Please try again later.",
                    500 => "OpenRouter server error. Please try again later.",
                    default => "Unexpected error: " . $response->status()
                };
            }

            // Extract and return AI response
            $responseData = $response->json();
            $aiResponse = $responseData['choices'][0]['message']['content'] ?? null;

            if (!$aiResponse) {
                Log::channel('openrouter')->warning('No content in OpenRouter response', [
                    'full_response' => $responseData
                ]);
                return "I couldn't generate a meaningful response.";
            }

            return $aiResponse;

        } catch (Exception $e) {
            // Catch any unexpected errors
            Log::channel('openrouter')->error('OpenRouter Service Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return "An unexpected error occurred: " . $e->getMessage();
        }
    }
}