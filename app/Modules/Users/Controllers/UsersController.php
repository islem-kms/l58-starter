<?php
/**
 * Created by PhpStorm.
 * User: Islem Khemissi
 */

namespace App\Modules\Users\Controllers;


use App\Http\Controllers\BaseApiController as Controller;
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
        $this->middleware('auth:api');

        $this->usersRepository = $usersRepository;
        $this->model = $model;
    }

    /**
     * List All users
     *
     * @OA\Get(
     *   path="/users",
     *   summary="List all users",
     *   tags = {"users"},
     *   operationId="index",
     *   @OA\Response(response=200, description="successful operation",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="code", type="integer", example=200),
     *       @OA\Property(property="message", type="string", example="users_list"),
     *       @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/User")),
     *     ),
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   security={
     *     {
     *       "Password Based": {*}
     *     }
     *   }
     * )
     *
     */
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
