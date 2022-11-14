<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardNewsCollection",
 *     description="Dashboard news collection",
 *     @OA\Xml(
 *         name="DashboardNewsCollection"
 *     )
 * )
 */
class DashboardNewsCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardNews[]
     */
    private $data;

    /**
     * @OA\Property(
     *     title="Pagination structure",
     *     description="Pagination structure"
     * )
     *
     * @var \App\Virtual\Resources\Pagination
     */
    private $meta;
}
