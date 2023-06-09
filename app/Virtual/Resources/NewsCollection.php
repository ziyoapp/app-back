<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="NewsCollection",
 *     description="News collection",
 *     @OA\Xml(
 *         name="NewsCollection"
 *     )
 * )
 */
class NewsCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\News[]
     */
    private $data;
}
