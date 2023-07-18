<?php

namespace App\Http\Controllers;

use App\Facades\Product as ProductFacade;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\StoreReviewRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\MinifiedProductResource;
use App\Http\Resources\Product\MinifiedProductV2Resource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductReviewResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')
            ->only(['store', 'update', 'review', 'destroy']);

        $this->middleware('admin')->only([
            'store', 'update', 'destroy',
        ]);

        $this->middleware('product.draft')->only('show');
    }

    public function index()
    {
        return MinifiedProductResource::collection(
            ProductFacade::published()
        );
    }

    public function indexV2()
    {
        return MinifiedProductV2Resource::collection(
            ProductFacade::published()
        );
    }

    public function store(StoreProductRequest $request)
    {
        return new ProductResource(ProductFacade::store($request));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = ProductFacade::setProduct($product)
            ->update($request);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return responseOk();
    }

    public function review(Product $product, StoreReviewRequest $request)
    {
        return new ProductReviewResource(
            ProductFacade::setProduct($product)->addReview($request)
        );
    }
}
