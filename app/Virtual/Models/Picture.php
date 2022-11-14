<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Picture",
 *     description="Picture",
 *     @OA\Xml(
 *         name="Picture"
 *     )
 * )
 */
class Picture
{
    /**
     * @OA\Property(
     *      title="Image id",
     *      description="Image id"
     * )
     *
     * @var int
     */
    public $id;

    /**
     * @OA\Property(
     *      title="Image path",
     *      description="Image path"
     * )
     *
     * @var string
     */
    public $src;
}
