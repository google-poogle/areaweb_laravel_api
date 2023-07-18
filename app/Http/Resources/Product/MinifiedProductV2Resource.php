<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Product
 */
class MinifiedProductV2Resource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'productName' => $this->name,
            'productPrice' => $this->price,
            'productRating' => $this->rating(),
        ];
    }
}
