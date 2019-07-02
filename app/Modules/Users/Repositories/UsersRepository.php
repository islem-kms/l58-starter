<?php
/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

namespace App\Modules\Users\Repositories;


use App\Modules\BaseApiRepositoryTrait;
use App\User;
use Illuminate\Validation\Rule;

class UsersRepository implements UsersRepositoryInterface
{
    use BaseApiRepositoryTrait;

    function model()
    {
        return User::class;
    }

    function validationRules($resource_id = 0)
    {
        $email_rules = 'required|string|email|max:255|unique:users';
        $password_rules = 'required|string|min:6';

        if ($resource_id) {
            $email_rules = [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($resource_id),
            ];

            $password_rules = 'string|min:6';
        }

        return [
            'name' => 'required|string|max:255',
            'email' => $email_rules,
            'password' => $password_rules,
        ];
    }
}
