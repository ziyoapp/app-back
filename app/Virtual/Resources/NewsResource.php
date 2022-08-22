<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="NewsResource",
 *     description="News resource",
 *     @OA\Xml(
 *         name="NewsResource"
 *     )
 * )
 */
class NewsResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\News
     */
    private $data;
}
