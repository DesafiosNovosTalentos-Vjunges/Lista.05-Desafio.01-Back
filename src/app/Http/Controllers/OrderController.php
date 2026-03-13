<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\DTOs\CreateOrderDTO;
use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderService $order_service;

    public function __construct(OrderService $order_service){
        $this->order_service = $order_service;
    }

    public function index(): JsonResponse {
        $orders = Order::where('user_id', request()->user()->id)->paginate(10);

        return response()->json($orders);
    }

    public function store(StoreOrderRequest $request): JsonResponse {
        $dto = CreateOrderDTO::fromRequest($request);
        $order = $this->order_service->createOrder($dto);

        return response()->json([
            'message' => 'Pedido criado com sucesso! A notificação será enviada em breve.',
            'order' => $order
        ], 201);
    }
}
