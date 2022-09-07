<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Labels",
 *     description="Labels",
 *     @OA\Xml(
 *         name="Labels"
 *     )
 * )
 */
class Labels
{
    /**
     * @OA\Property(
     *      title="Constant name label",
     *      description="Constant name label",
     *      example="new"
     * )
     *
     * @var string
     */
    public $code;

    /**
     * @OA\Property(
     *      title="Label name",
     *      description="Label name",
     *      example="Новое"
     * )
     *
     * @var string
     */
    public $name;
}
