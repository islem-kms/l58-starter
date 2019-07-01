<?php
/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

namespace App\Modules\Users\Repositories;


use App\Modules\BaseApiRepositoryTrait;
use App\User;

class UsersRepository implements UsersRepositoryInterface
{
    use BaseApiRepositoryTrait;

    function model()
    {
        return User::class;
    }

    function validationRules($resource_id = 0)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}