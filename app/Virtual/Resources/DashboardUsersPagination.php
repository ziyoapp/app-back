<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardUsersPagination",
 *     @OA\Xml(
 *         name="DashboardUsersPagination"
 *     )
 * )
 */
class DashboardUsersPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\User[]
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
