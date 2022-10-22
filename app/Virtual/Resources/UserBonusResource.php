<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="UserBonusResource",
 *     description="User bonus resource",
 *     @OA\Xml(
 *         name="UserBonusResource"
 *     )
 * )
 */
class UserBonusResource
{
    /**
     * @OA\Property(
     *     title="User ball",
     *     description="User total ball"
     * )
     *
     * @var float
     */
    public $ball;
}
