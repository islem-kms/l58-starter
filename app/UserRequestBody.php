<?php


namespace App;

/**
 * Class User
 *
 * @package Users
 *
 * @author  Islem Khemissi <khemissi.islem@gmail.com>
 *
 * @OA\Schema(
 *     description="User model",
 *     title="UserRequestBody",
 *     required={"name", "email"},
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class UserRequestBody {

    /**
     * @OA\Property(
     *     description="User's name",
     *     title="Name",
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     description="User's email",
     *     title="Email",
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     description="User's password",
     *     title="Password",
     * )
     *
     * @var string
     */
    private $password;

}
