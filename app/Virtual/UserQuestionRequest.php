<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User question request",
 *      description="User question request body data",
 *      type="object",
 *      required={"email", "text"}
 * )
 */
class UserQuestionRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email",
     *      example="example@mail.ru"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Question text",
     *      description="Question text"
     * )
     *
     * @var string
     */
    public $text;
}
