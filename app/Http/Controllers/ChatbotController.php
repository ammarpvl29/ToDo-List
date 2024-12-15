<?php

namespace App\Http\Controllers;

use App\Services\OpenRouterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Add this import

class ChatbotController extends Controller
{
    protected $openRouterService;

    public function __construct(OpenRouterService $openRouterService)
    {
        $this->openRouterService = $openRouterService;
    }

    public function handleChatbotRequest(Request $request)
    {
        $userMessage = $request->input('message');
        
        // Validate input
        if (empty($userMessage)) {
            return response()->json([
                'message' => 'Please provide a message.'
            ], 400);
        }
        
        try {
            $aiResponse = $this->openRouterService->generateResponse($userMessage);
            
            return response()->json([
                'message' => $aiResponse
            ]);
        } catch (\Exception $e) {
            Log::error('Chatbot Request Error: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Sorry, I encountered an error processing your request.'
            ], 500);
        }
    }
}