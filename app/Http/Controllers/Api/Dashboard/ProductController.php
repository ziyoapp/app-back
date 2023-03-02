<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Enums\BonusLogStatus;
use App\Enums\BonusLogType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListRequest;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductOrderStatusRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductOrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *      path="/dashboard/products/orders",
     *      operationId="getDashOrdersList",
     *      tags={"Dashboard Shop Orders"},
     *      summary="Get orders list",
     *      description="Return orders list",
     *     @OA\Parameter(
     *          name="sort",
     *          description="Sort by published at [asc, desc]",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardProductPagination")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function getOrders(ListRequest $request, ProductService $productService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        return ProductOrderResource::collection(
            $productService->listProductOrders($perPage, $sort)
        );
    }


    /**
     * @OA\Post(
     *      path="/dashboard/products/order-status",
     *      operationId="productOrderStatusChange",
     *      tags={"Dashboard Shop Orders"},
     *      summary="Order status change",
     *      description="Order status change",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardProductRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardProductResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function productOrderStatus(ProductOrderStatusRequest $request, ProductService $productService)
    {
        $productOrder = $productService->orderStatusChange($request->get('order_id'), $request->get('status'));
        return new ProductOrderResource($productOrder);
    }

    /**
     * @OA\Get(
     *      path="/dashboard/products",
     *      operationId="getDashProductsList",
     *      tags={"Dashboard Shop Products"},
     *      summary="Get products list",
     *      description="Return products list",
     *     @OA\Parameter(
     *          name="sort",
     *          description="Sort by published at [asc, desc]",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardProductPagination")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function list(ListRequest $request, ProductService $productService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        $productList = $productService->list($perPage, $sort);

        return ProductResource::collection($productList);
    }

    /**
     * @OA\Get(
     *      path="/dashboard/category/{id}/products",
     *      operationId="getDashProductByCategoryId",
     *      tags={"Dashboard Shop Products"},
     *      summary="Get products by category id",
     *      description="Return products by category id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="sort",
     *          description="Sort by published at [asc, desc]",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
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
     *          @OA\JsonContent(ref="#/components/schemas/DashboardProductPagination")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function listByCategoryId(int $categoryId, ListRequest $request, ProductService $productService)
    {
        $perPage = (int) $request->get('per_page', 15);
        $sort = (string) $request->get('sort', 'desc');

        $productList = $productService->listByCategory($categoryId, $perPage, $sort);

        return ProductResource::collection($productList);
    }

    /**
     * @OA\Get(
     *      path="/dashboard/products/{id}",
     *      operationId="getDashProductById",
     *      tags={"Dashboard Shop Products"},
     *      summary="Get product by id",
     *      description="Return product by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardProductResource")
     *       )
     * )
     */
    public function getItem(int $productId)
    {
        $product = Product::withoutGlobalScope('published')->findOrFail($productId);

        return new ProductResource($product);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/products",
     *      operationId="createProductDash",
     *      tags={"Dashboard Shop Products"},
     *      summary="Create product",
     *      description="Create product",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardProductRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardProductResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function create(ProductCreateRequest $request, ProductService $productService)
    {
        $product = $productService->create($request->validated());
        return new ProductResource($product);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/products/{id}",
     *      operationId="updateProductDash",
     *      tags={"Dashboard Shop Products"},
     *      summary="Update product",
     *      description="Update product",
     *     @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="_method",
     *          description="HTTP PUT: [only - PUT]",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/DashboardProductRequest")
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardProductResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function update(int $productId, ProductUpdateRequest $request, ProductService $productService)
    {
        $product = $productService->update($productId, $request->validated());
        return new ProductResource($product);
    }

    /**
     * @OA\Delete(
     *      path="/dashboard/products/{id}",
     *      operationId="deleteProductById",
     *      tags={"Dashboard Shop Products"},
     *      summary="Delete product by id",
     *      description="Delete product by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     */
    public function delete(int $productId)
    {
        $product = Product::withoutGlobalScope('published')->findOrFail($productId);
        $product->delete();

        return response()->json();
    }

    /**
     * @OA\Delete(
     *      path="/dashboard/image/{id}",
     *      operationId="deleteImageById",
     *      tags={"Dashboard"},
     *      summary="Delete image by id",
     *      description="Delete image by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Image id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       )
     * )
     */
    public function deleteImage(int $mediaId)
    {
        $media = Media::query()->findOrFail($mediaId);
        $media->delete();

        return response()->json();
    }
}
