<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\Product\ProductService setProduct(\App\Models\Product $product)
 * @method static \App\Models\Product[] published(array $fields = ['id', 'name', 'price'])
 * @method static \App\Models\Product store(\App\Services\Product\DTO\CreateProductData $data)
 * @method static \App\Models\Product update(\App\Http\Requests\Product\UpdateProductRequest $request)
 * @method static \App\Models\ProductReview addReview(\App\Http\Requests\Product\StoreReviewRequest $request)
 *
 * @see \App\Services\Product\ProductService
 */
class Product extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'product';
    }
}
