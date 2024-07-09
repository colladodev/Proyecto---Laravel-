<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $response = $this->getResponse($message);
        return response()->json(['response' => $response]);
    }

    private function getResponse($message)
    {
        // Convertimos el mensaje a minúsculas para hacer la comparación sin distinguir mayúsculas y minúsculas
        $lowercaseMessage = strtolower($message);

        if ($lowercaseMessage === 'hola') {
            return 'Saludo humano, esto es una prueba que estamos utilizando framework Laravel';
        }

        // Respuesta por defecto si no es "hola"
        return "Lo siento, no entiendo ese mensaje. Prueba diciendo 'Hola'.";
    }
}