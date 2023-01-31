<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="StoriesList",
 *     description="StoriesList model",
 *     @OA\Xml(
 *         name="StoriesList"
 *     )
 * )
 */
class StoriesList
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $id;

    /**
     * @OA\Property(
     *      title="Story name",
     *      description="Story name"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Image src",
     *      description="Image src"
     * )
     *
     * @var string
     */
    public $preview_img_url;

    /**
     * @OA\Property(
     *      title="Image paths collection",
     *      description="Image paths collection",
     * )
     *
     * @var string[]
     */
    public $images;
}
