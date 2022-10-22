<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="BonusHistoryList",
 *     description="Bonus history model",
 *     @OA\Xml(
 *         name="BonusHistoryList"
 *     )
 * )
 */
class BonusHistoryList
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
     *      title="Opration type",
     *      description="Type event: add or minus",
     *      example="add"
     * )
     *
     * @var string
     */
    public $operation_type;

    /**
     * @OA\Property(
     *      title="History title",
     *      description="History title",
     *      example="History title"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="History ball",
     *      description="History ball",
     *      example="+230"
     * )
     *
     * @var string
     */
    public $ball;

    /**
     * @OA\Property(
     *      title="Currency",
     *      description="Currency",
     *      example="YC"
     * )
     *
     * @var string
     */
    public $currency;

    /**
     * @OA\Property(
     *     title="Date created at",
     *     description="Date created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $date;
}
