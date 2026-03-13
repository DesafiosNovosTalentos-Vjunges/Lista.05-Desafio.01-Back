<?php

namespace App\Services;

use App\DTOs\CreateOrderDTO;
use App\Models\Order;
use App\Jobs\SendOrderNotificationJob;
use Illuminate\Support\Facades\DB;

class OrderService {
    public function CreateOrder(CreateOrderDTO $dto): Order {
        return DB::transaction(function () use ($dto){
            $order = Order::create([
                'user_id' => $dto->userId,
                'product_name' => $dto->productName,
                'amount' => $dto->amount,
                'status' => 'pending', 
            ]);

            return $order;
        });
    }
}
