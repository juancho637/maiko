<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiControllerV1;

/**
 * @OA\Tag(
 *     name="Autenticación",
 *     description="Endpoints para la autenticación"
 * )
 */
class AuthController extends ApiControllerV1
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    /**
     * @OA\Post(
     *     path="/auth/login",
     *     summary="Login de usuarios para la API",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el token de autenticación.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Usuario no verificado.",
     *     ),
     * )
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return $this->errorResponse(__('Unauthorized'), 401);
        }

        if (!$request->user('api')->email_verified_at) {
            return $this->errorResponse(__('User not verified'), 403);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *     path="/auth/me",
     *     summary="Usuario autenticado",
     *     tags={"Autenticación"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el usuario autenticado.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function me()
    {
        return $this->showOne(Auth::guard('api')->user());
    }

    /**
     * @OA\Post(
     *     path="/auth/logout",
     *     summary="Elimina el token de autenticación",
     *     tags={"Autenticación"},
     *     @OA\Response(
     *         response=200,
     *         description="Elimina el token de autenticación.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return $this->successMessage(__('Successfully logged out'));
    }

    /**
     * @OA\Post(
     *     path="/auth/refresh",
     *     summary="Refresca el token de autenticación",
     *     tags={"Autenticación"},
     *     @OA\Response(
     *         response=200,
     *         description="Muestra el token de autenticación.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Usuario no autorizado.",
     *     ),
     *     security={ {"bearer": {}} },
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}
