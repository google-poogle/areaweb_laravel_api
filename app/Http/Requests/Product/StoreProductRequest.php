<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductStatus;
use App\Http\Requests\ApiRequest;
use App\Services\Product\DTO\CreateProductData;
use Illuminate\Validation\Rules\Enum;

class StoreProductRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'desc' => ['string'],
            'price' => ['required', 'numeric', 'min:1', 'max:100000'],
            'count' => ['required', 'int', 'min:0', 'max:1000'],
            'state' => ['required', new Enum(ProductStatus::class)],
            'images.*' => ['image'],
        ];
    }

    public function data(): CreateProductData
    {
        return CreateProductData::from($this->validated());
    }
}
