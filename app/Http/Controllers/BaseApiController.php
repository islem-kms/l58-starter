<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 * version="1.0.0",
 * title="KMS Starter - Open API",
 * description="APIs documentation usin OpenAPI",
 * @OA\Contact(
 *   name="Islem Khemissi",
 *   url="https://www.linkedin.com/in/islem-khemissi",
 *   email="khemissi.islem@gmail.com"
 *   )
 * )
 *
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_HOST,
 *   description="a local dev server"
 * )
 *
 */

/**
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     description="Use a global client_id / client_secret and your username / password combo to obtain a token",
 *     name="Password Based",
 *     in="header",
 *     scheme="https",
 *     securityScheme="Password Based",
 *     @OA\Flow(
 *         flow="password",
 *         authorizationUrl=AUTHORIZATION_URL,
 *         tokenUrl=TOKEN_URL,
 *         refreshUrl=REFRESH_URL,
 *         scopes={}
 *     )
 * )
 */

class BaseApiController extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
