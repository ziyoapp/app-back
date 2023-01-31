<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardStoriesPagination",
 *     @OA\Xml(
 *         name="DashboardStoriesPagination"
 *     )
 * )
 */
class DashboardStoriesPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardStories[]
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
