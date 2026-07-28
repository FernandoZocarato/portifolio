<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function __invoke(StoreContactRequest $request): JsonResponse
    {
        ContactMessage::create([
            ...$request->safe()->except('website'),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contato registrado com sucesso.',
        ], 201);
    }
}
