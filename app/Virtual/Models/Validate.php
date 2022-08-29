<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Validate",
 *     description="Validate",
 *     @OA\Xml(
 *         name="Validate"
 *     )
 * )
 */
class Validate
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
    public $message;

    /**
     * @OA\Property(
     *      title="Errors list",
     *      description="Errors list",
     *      @OA\Items(
     *          type="array",
     *          @OA\Items()
     *      )
     * )
     *
     * @var array
     */
    public $errors;
}
