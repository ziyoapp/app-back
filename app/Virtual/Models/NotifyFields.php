<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="NotifyFields",
 *     description="NotifyFields",
 *     @OA\Xml(
 *         name="NotifyFields"
 *     )
 * )
 */
class NotifyFields
{
    /**
     * @OA\Property(
     *      title="Notify title",
     *      description="Notify title"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Notify content",
     *      description="Notify content"
     * )
     *
     * @var string
     */
    public $content;
}
