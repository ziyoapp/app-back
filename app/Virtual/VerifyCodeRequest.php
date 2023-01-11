<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="User verify code request",
 *      description="User verify code request body data",
 *      type="object",
 *      required={"phone"}
 * )
 */
class VerifyCodeRequest
{
    /**
     * @OA\Property(
     *      title="Phone number",
     *      description="Phone number",
     *      example="998939887080"
     * )
     *
     * @var string
     */
    public $phone;
}
