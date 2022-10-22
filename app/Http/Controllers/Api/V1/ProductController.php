<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductListResource;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/shop/categories/{id}/products",
     *      operationId="getProductsInCategory",
     *      tags={"Shop"},
     *      summary="Get products in category",
     *      description="Get products in category",
     *     @OA\Parameter(
     *          name="page",
     *          description="Page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="per_page",
     *          description="Per page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProductsPagination")
     *       )
     * )
     */
    public function categoryProducts(Request $request, $categoryId)
    {
        $perPage = (int) $request->get('per_page', 15);

        $products = Product::query()->with(['categories' => function($q) {
            return $q->select(['id', 'name']);
        }]);

        if ($categoryId !== 'all') {
            $products->whereHas('categories', function($q) use ($categoryId) {
                return $q->where('id', $categoryId);
            });
        }

        return ProductListResource::collection($products->paginate($perPage));
    }

    /**
     * @OA\Get(
     *      path="/shop/products/{id}",
     *      operationId="getProductById",
     *      tags={"Shop"},
     *      summary="Get product by id",
     *      description="Get product by id",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *       )
     * )
     */
    public function product($id)
    {
        $product = Product::query()->with(['categories' => function($q) {
            return $q->select(['id', 'name']);
        }])->findOrFail($id);

        return new ProductResource($product);
    }
}
