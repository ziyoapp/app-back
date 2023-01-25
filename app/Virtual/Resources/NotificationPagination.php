<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="NotificationPagination",
 *     description="Notification pagination",
 *     @OA\Xml(
 *         name="NotificationPagination"
 *     )
 * )
 */
class NotificationPagination
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\NotificationList[]
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
