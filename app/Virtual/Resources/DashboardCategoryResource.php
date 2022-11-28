<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardCategoryResource",
 *     description="Dashboard category resource",
 *     @OA\Xml(
 *         name="DashboardCategoryResource"
 *     )
 * )
 */
class DashboardCategoryResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardCategory
     */
    private $data;
}
