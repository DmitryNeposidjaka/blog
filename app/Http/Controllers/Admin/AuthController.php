<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 23.02.18
 * Time: 18:40
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\JWTAuthExtended;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * @var JWTAuthExtended
     */
    private $jwt;


    public function __construct(JWTAuthExtended $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login'    => 'required|string|max:255',
            'password' => 'required',
        ]);

        try {

            if (! $token = $this->jwt->login($request->only('login', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return $this->respondWithToken($token);
    }

    public function refreshToken(Request $request)
    {
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
            'accessToken' => $token,
            'refreshToken' => 'bearer',
            'expires_in' => $this->jwt->factory()->getTTL() * 60
        ]);
    }
}