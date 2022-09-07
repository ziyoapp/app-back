<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="NewsPagination",
 *     description="News pagination",
 *     @OA\Xml(
 *         name="NewsPagination"
 *     )
 * )
 */
class NewsPagination
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
