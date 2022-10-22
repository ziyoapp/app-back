<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="BonusHistoryPagination",
 *     description="Bonus history pagination",
 *     @OA\Xml(
 *         name="BonusHistoryPagination"
 *     )
 * )
 */
class BonusHistoryPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\BonusHistoryList[]
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
