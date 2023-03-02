<?php

namespace App\Services;

use App\Enums\BonusLogStatus;
use App\Enums\BonusLogType;
use App\Models\Bonus;
use App\Models\BonusLog;
use App\Models\Event;
use App\Models\Product;
use App\Services\Traits\UploadImage;
use App\Services\V1\BonusLogService;
use Illuminate\Support\Facades\DB;

class ProductService
{
    use UploadImage;

    public function create(array $data): Product
    {
        DB::beginTransaction();

        try {
            $product = Product::create(array_merge($data, [
                'price_old' => !empty($data['price_old']) ? $data['price_old'] : 0
            ]));
            $product->categories()->sync($data['category_id']);

            if (!empty($data['images'])) {
                foreach ($data['images'] as $img) {
                    $this->uploadPicture($product, $img);
                }
            }

            $product->load(['media', 'categories']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $product;
    }

    public function update(int $productId, array $data): Product
    {
        $product = Product::withoutGlobalScope('published')->findOrFail($productId);

        DB::beginTransaction();

        try {
            $product->update(array_merge($data, [
                'price_old' => !empty($data['price_old']) ? $data['price_old'] : 0
            ]));
            $product->categories()->sync($data['category_id']);

            if (!empty($data['images'])) {
                foreach ($data['images'] as $img) {
                    $this->uploadPicture($product, $img);
                }
            }

            $product->load(['media', 'categories']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return $product;
    }

    public function list(int $perPage = 15, string $order = 'desc')
    {
        $products = Product::withoutGlobalScope('published')->orderBy('sort', $order);
        return $products->paginate($perPage);
    }

    public function listProductOrders(int $perPage = 15, string $order = 'desc')
    {
        return BonusLog::query()->with('user')->where('type', BonusLogType::PRODUCT)
                ->orderBy('id', $order)
                ->paginate($perPage);
    }

    public function orderStatusChange(int $orderId, string $status): BonusLog
    {
        /**
         * @var BonusLog $productOrder
         */
        $productOrder = BonusLog::query()->with('user')->findOrFail($orderId);

        if (!empty($productOrder->status) && in_array($productOrder->status, [BonusLogStatus::COMPLETED, BonusLogStatus::CANCELED])) {
            return $productOrder;
        }

        $productOrder->status = $status;
        $productOrder->save();

        if (BonusLogStatus::CANCELED === $status) {
            Bonus::query()->where('user_id', $productOrder->user_id)->increment('ball', abs($productOrder->ball));
        }

        return $productOrder;
    }

    public function listByCategory(int $categoryId, int $perPage = 15, string $order = 'desc')
    {
        $products = Product::withoutGlobalScope('published')
            ->whereHas('categories', function($q) use ($categoryId) {
                return $q->where('id', $categoryId);
            })
            ->orderBy('sort', $order);

        return $products->paginate($perPage);
    }
}
