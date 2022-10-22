<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/shop/categories",
     *      operationId="getShopCategories",
     *      tags={"Shop"},
     *      summary="Get list of shop categories",
     *      description="Get list of shop categories",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProductCategoryCollection")
     *       )
     * )
     */
    public function categories()
    {
        $categories = ProductCategory::query()
                            ->select(['id', 'name'])
                            ->withCount('products')
                            ->orderByDesc('sort')
                            ->get();

        $categories->prepend([
            'id' => 'all',
            'name' => __('Все'),
            'products_count' => $categories->sum('products_count')
        ]);

        return response()->json([
            'data' => $categories
        ]);
    }
}
