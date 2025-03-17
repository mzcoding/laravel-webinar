<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Output\RabbitMqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RabbitMQController extends Controller
{
    public function __invoke(Request $request, RabbitMqService $rabbitMqService)
    {
        try {
            $rabbitMqService->sendMessage($request->get('message'));
            $rabbitMqService->closeConnection();
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return response($exception->getMessage(), 500)
                ->header('Content-Type', 'application/json');
        }
    }
}
