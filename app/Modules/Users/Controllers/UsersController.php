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

    /**
     * Create a new user
     *
     * @OA\Post(
     *   path="/users",
     *   summary="Create a new user",
     *   tags = {"users"},
     *   operationId="store",
     *   requestBody={"$ref": "#/components/requestBodies/User"},
     *   @OA\Response(response=200, description="successful operation",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="code", type="integer", example=200),
     *       @OA\Property(property="message", type="string", example="user_created"),
     *       @OA\Property(property="data", @OA\Items(ref="#/components/schemas/User")),
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
    public function store(Request $request)
    {
        return $this->usersRepository->create($request->only($this->model->getFillable()));
    }

    /**
     * Show an existing user
     *
     * @OA\Get(
     *   path="/users/{user_id}",
     *   summary="Show an existing user",
     *   tags = {"users"},
     *   operationId="show",
     *   @OA\Parameter(name="user_id", in="path", description="ID of user to return", required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(response=200, description="successful operation",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="code", type="integer", example=200),
     *       @OA\Property(property="message", type="string", example="user_details"),
     *       @OA\Property(property="data", @OA\Items(ref="#/components/schemas/User")),
     *     ),
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   security={
     *     {
     *       "Password Based": {*}
     *     }
     *   }
     * )
     */
    public function show($user_id)
    {
        return $this->usersRepository->show($user_id);
    }

    /**
     * Update an existing user
     *
     * @OA\Put(
     *   path="/users/{user_id}",
     *   summary="Update an existing user",
     *   tags = {"users"},
     *   operationId="update",
     *   requestBody={"$ref": "#/components/requestBodies/User"},
     *   @OA\Parameter(name="user_id", in="path", description="ID of user to return", required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(response=200, description="successful operation",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="code", type="integer", example=200),
     *       @OA\Property(property="message", type="string", example="user_updated"),
     *       @OA\Property(property="data", @OA\Items(ref="#/components/schemas/User")),
     *     ),
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   security={
     *     {
     *       "Password Based": {*}
     *     }
     *   }
     * )
     * @param Request $request
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $user_id)
    {
        return $this->usersRepository->update($user_id, $request->only($this->model->getFillable()));
    }

    /**
     * Delete an existing user
     *
     * @OA\Delete(
     *   path="/users/{user_id}",
     *   summary="Delete an existing user",
     *   tags = {"users"},
     *   operationId="destroy",
     *   @OA\Parameter(name="user_id", in="path", description="ID of user to return", required=true,
     *     @OA\Schema(type="integer", format="int64")
     *   ),
     *   @OA\Response(response=200, description="successful operation",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="code", type="integer", example=200),
     *       @OA\Property(property="message", type="string", example="user_deleted"),
     *       @OA\Property(property="data", @OA\Items(ref="#/components/schemas/User")),
     *     ),
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   security={
     *     {
     *       "Password Based": {*}
     *     }
     *   }
     * )
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($user_id)
    {
        return $this->usersRepository->delete($user_id);
    }

}
