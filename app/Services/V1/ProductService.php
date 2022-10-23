<?php

namespace App\Services\V1;

use App\Enums\BonusLogOperation;
use App\Enums\BonusLogType;
use App\Exceptions\BadRequestException;
use App\Models\BonusLogProp;
use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductService
{
    protected $bonusLogService;

    public function __construct()
    {
        $this->bonusLogService = new BonusLogService();
    }

    public function productBuy(int $productId, int $userId)
    {
        try {
            DB::beginTransaction();

            $product = Product::findOrFail($productId);
            $user = User::with('bonus')->findOrFail($userId);

            if (!isset($user->bonus->ball) || $user->bonus->ball < $product->price) {
                DB::rollBack();
                throw new BadRequestException(__('bad_request.product_buy_price'));
            }

            if ($product->quantity < 1) {
                DB::rollBack();
                throw new BadRequestException(__('bad_request.product_buy_quantity'));
            }

            $product->decrement('quantity', 1);

            $this->bonusLogService->updateUserBalance(
                $userId,
                $product->price,
                BonusLogType::PRODUCT,
                BonusLogOperation::MINUS,
                new BonusLogProp([
                    'entity_id' => $product->id,
                    'entity_type' => Product::class
                ])
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
