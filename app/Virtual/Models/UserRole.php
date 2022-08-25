<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="User role",
 *     description="User role",
 *     @OA\Xml(
 *         name="User role"
 *     )
 * )
 */
class UserRole
{
    /**
     * @OA\Property(
     *     title="Role id",
     *     description="Role id",
     *     format="int64",
     *     example=3
     * )
     *
     * @var integer
     */
    public $role_id;

    /**
     * @OA\Property(
     *      title="Role name",
     *      description="Role name",
     *      example="user"
     * )
     *
     * @var string
     */
    public $role_name;
}
