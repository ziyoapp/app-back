<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardCategoryCollection",
 *     description="Dashboard category resource",
 *     @OA\Xml(
 *         name="DashboardCategoryResource"
 *     )
 * )
 */
class DashboardCategoryCollection
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardCategory[]
     */
    private $data;
}
