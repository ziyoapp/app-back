<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DashboardStoriesResource",
 *     @OA\Xml(
 *         name="DashboardStoriesResource"
 *     )
 * )
 */
class DashboardStoriesResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\DashboardStories
     */
    private $data;
}
