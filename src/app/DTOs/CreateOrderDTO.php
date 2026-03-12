<?php

namespace App\DTOs;

class CreateOrderDTO{
    public readonly string $userId;
    public readonly string $productName;
    public readonly float $amount;

    public function __construct(string $userId, string $productName, float $amount){
        $this->userId = $userId;
        $this->productName = $productName;
        $this->amount = $amount;
    }

    public static function fromRequest($request): self {
        return new self(
            $request->user()->id,
            $request->validated('product_name'),
            (float) $request->validated('amount')
        );
    }
}
