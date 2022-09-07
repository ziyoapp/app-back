<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="EventsPagination",
 *     description="Events pagination",
 *     @OA\Xml(
 *         name="EventsPagination"
 *     )
 * )
 */
class EventsPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\EventsList[]
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
