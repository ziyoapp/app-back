<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Bad Request",
 *     description="Bad Request",
 *     @OA\Xml(
 *         name="Bad Request"
 *     )
 * )
 */
class BadRequest
{
    /**
     * @OA\Property(
     *      title="Error message",
     *      description="Error message",
     *      example="Error text"
     * )
     *
     * @var string
     */
    public $error;
}
