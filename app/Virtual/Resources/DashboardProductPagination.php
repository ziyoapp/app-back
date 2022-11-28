<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardProductPagination",
 *     description="Dashboard product collection",
 *     @OA\Xml(
 *         name="DashboardProductPagination"
 *     )
 * )
 */
class DashboardProductPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardProduct[]
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
