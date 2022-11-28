<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardProductResource",
 *     description="Dashboard product resource",
 *     @OA\Xml(
 *         name="DashboardProductResource"
 *     )
 * )
 */
class DashboardProductResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardProduct
     */
    private $data;
}
