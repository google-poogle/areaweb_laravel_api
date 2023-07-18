<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\StoreReviewRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')
            ->only(['store', 'update', 'review', 'destroy']);

        $this->middleware('admin')->only([
            'store', 'update', 'destroy',
        ]);
    }

    public function index()
    {
        $products = Product::query()
            ->select(['id', 'name', 'price'])
            ->whereStatus(ProductStatus::Published)
            ->get();

        // TODO: использовать API ресурсы
        return $products->map(fn (Product $product) => [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'rating' => $product->rating(),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        /** @var Product $product */
        $product = auth()->user()->products()->create([
            'name' => $request->str('name'),
            'description' => $request->str('description'),
            'price' => $request->input('price'),
            'count' => $request->integer('count'),
            'status' => $request->enum('status', ProductStatus::class),
        ]);

        foreach ($request->file('images') as $item) {
            $path = $item->storePublicly('images');

            $product->images()->create([
                'url' => config('app.url').Storage::url($path),
            ]);
        }

        return response()->json([
            'id' => $product->id,
        ], 201);
    }

    public function show(Product $product)
    {
        // TODO: перенести в middleware
        if ($product->status === ProductStatus::Draft) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'rating' => $product->rating(),
            'images' => $product->images->map(fn (ProductImage $image) => $image->url),
            'price' => $product->price,
            'count' => $product->count,
            'reviews' => $product->reviews->map(fn (ProductReview $review) => [
                'id' => $review->id,
                'userName' => $review->user->name,
                'text' => $review->text,
                'rating' => $review->rating,
            ]),
        ];
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->method() === 'PUT') {
            $product->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'count' => $request->input('count'),
                'status' => $request->enum('status', ProductStatus::class),
            ]);
        } else {
            $data = [];

            // TODO: использовать DTO

            if ($request->has('name')) {
                $data['name'] = $request->input('name');
            }

            if ($request->has('description')) {
                $data['description'] = $request->input('description');
            }

            if ($request->has('price')) {
                $data['price'] = $request->input('price');
            }

            if ($request->has('count')) {
                $data['count'] = $request->input('count');
            }

            if ($request->has('status')) {
                $data['status'] = $request->input('status');
            }

            $product->update($data);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function review(Product $product, StoreReviewRequest $request)
    {
        return $product->reviews()->create([
            'user_id' => auth()->id(),
            'text' => $request->str('text'),
            'rating' => $request->integer('rating'),
        ])->only('id');
    }
}