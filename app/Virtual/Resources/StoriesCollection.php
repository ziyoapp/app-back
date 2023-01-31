<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="StoriesCollection",
 *     description="StoriesCollection resource",
 *     @OA\Xml(
 *         name="StoriesCollection"
 *     )
 * )
 */
class StoriesCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\StoriesList[]
     */
    private $data;
}
