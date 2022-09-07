<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="Pagination",
 *     description="Pagination",
 *     @OA\Xml(
 *         name="Pagination"
 *     )
 * )
 */
class Pagination
{
    /**
     * @OA\Property(
     *      title="Current page",
     *      description="Current page",
     *      example="1"
     * )
     *
     * @var int
     */
    private $current_page;

    /**
     * @OA\Property(
     *      title="From page",
     *      description="From page",
     *      example="1"
     * )
     *
     * @var int
     */
    private $from;

    /**
     * @OA\Property(
     *      title="Last page",
     *      description="Last page",
     *      example="10"
     * )
     *
     * @var int
     */
    private $last_page;

    /**
     * @OA\Property(
     *      title="To page",
     *      description="To page",
     *      example="10"
     * )
     *
     * @var int
     */
    private $to;

    /**
     * @OA\Property(
     *      title="Total items",
     *      description="Total items",
     *      example="30"
     * )
     *
     * @var int
     */
    private $total;
}
