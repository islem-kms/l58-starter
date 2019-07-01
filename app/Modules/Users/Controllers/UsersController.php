<?php
/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

namespace App\Modules\Users\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\Users\Repositories\UsersRepository;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;
    /**
     * @var User
     */
    private $model;

    /**
     * UsersController constructor.
     * @param UsersRepository $usersRepository
     * @param User $model
     */
    public function __construct(UsersRepository $usersRepository, User $model)
    {
        $this->usersRepository = $usersRepository;
        $this->model = $model;
    }

    public function index()
    {
        return $this->usersRepository->index();
    }

    public function store(Request $request)
    {
        return $this->usersRepository->create($request->only($this->model->getFillable()));
    }

    public function show($user_id)
    {
        return $this->usersRepository->show($user_id);
    }

    public function update(Request $request, $user_id)
    {
        return $this->usersRepository->update($user_id, $request->only($this->model->getFillable()));
    }

    public function destroy($user_id)
    {
        return $this->usersRepository->delete($user_id);
    }

}