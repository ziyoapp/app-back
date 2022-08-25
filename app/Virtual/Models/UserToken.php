<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User token",
 *     description="User token",
 *     @OA\Xml(
 *         name="User token"
 *     )
 * )
 */
class UserToken
{
    /**
     * @OA\Property(
     *      title="Token",
     *      description="User token",
     *      example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9ib251cy1hcHAudGVzdFwvYXBpXC92MVwvdXNlclwvbG9naW4iLCJpYXQiOjE2NjE0NTk0MTEsImV4cCI6MTY2MTQ2MzAxMSwibmJmIjoxNjYxNDU5NDExLCJqdGkiOiJCdzBkRUFZeUFvZzVXQXk1Iiwic3ViIjo3LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.ekZBR8qs1OAdU_uQAkV4DAkwdfetaaYc4HbJj0ogO8U"
     * )
     *
     * @var string
     */
    public $token;

    /**
     * @OA\Property(
     *     title="Token expire",
     *     description="oken expire",
     *     format="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    public $expire_in;
}
