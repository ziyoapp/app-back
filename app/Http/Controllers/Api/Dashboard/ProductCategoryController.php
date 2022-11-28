<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Exceptions\BadRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * @OA\Get(
     *      path="/dashboard/category",
     *      operationId="getCatList",
     *      tags={"Dashboard Shop Category"},
     *      summary="Get categories list",
     *      description="Return categories list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardCategoryCollection")
     *       )
     * )
     */
    public function getCategories()
    {
        return CategoryResource::collection(ProductCategory::orderByDesc('sort')->get());
    }

    /**
     * @OA\Get(
     *      path="/dashboard/category/{id}",
     *      operationId="getCatById",
     *      tags={"Dashboard Shop Category"},
     *      summary="Get category by id",
     *      description="Return category by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardCategoryResource")
     *       )
     * )
     */
    public function getItem(int $id)
    {
        $category = ProductCategory::findOrFail($id);
        return new CategoryResource($category);
    }

    /**
     * @OA\Post(
     *      path="/dashboard/category",
     *      operationId="createCategory",
     *      tags={"Dashboard Shop Category"},
     *      summary="Create category",
     *      description="Create category",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CategoryRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardCategoryResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function create(CategoryCreateRequest $request)
    {
        $categoryExists = ProductCategory::query()->where('name', $request->get('name'))->exists();
        if ($categoryExists) {
            throw new BadRequestException(__('Категория с таким названием уже существует'));
        }

        $category = ProductCategory::create($request->validated());

        return new CategoryResource($category);
    }

    /**
     * @OA\Put(
     *      path="/dashboard/category/{id}",
     *      operationId="updateCategoryById",
     *      tags={"Dashboard Shop Category"},
     *      summary="Update category by id",
     *      description="Update category by id",
     *     @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
     *          @OA\JsonContent(ref="#/components/schemas/CategoryRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DashboardCategoryResource")
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="Bad Request",
     *          @OA\JsonContent(ref="#/components/schemas/Validate")
     *      )
     * )
     */
    public function update(int $id, CategoryUpdateRequest $request)
    {
        $categoryExists = ProductCategory::query()
                ->where('id', '!=', $id)
                ->where('name', $request->get('name'))->exists();

        if ($categoryExists) {
            throw new BadRequestException(__('Категория с таким названием уже существует'));
        }

        $category = ProductCategory::findOrFail($id);
        $category->update($request->validated());

        return new CategoryResource($category);
    }

    /**
     * @OA\Delete(
     *      path="/dashboard/category/{id}",
     *      operationId="deleteCatById",
     *      tags={"Dashboard Shop Category"},
     *      summary="Delete category by id",
     *      description="Delete category by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
    public function delete(int $id)
    {
        ProductCategory::where('id', $id)->delete();

        return response()->json();
    }
}
