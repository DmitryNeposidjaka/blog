<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Lcobucci\JWT\Parser;
use Tymon\JWTAuth\Http\Parser\AuthHeaders;
use Tymon\JWTAuth\JWTAuth;


class Refresh
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $jwt;
    protected $parser;
    protected $headers;

    /**
     * Create a new middleware instance.
     *
     * @param $jwt
     * @param $parser
     * @param $headers
     * @return void
     */
    public function __construct(JWTAuth $jwt, Parser $parser, AuthHeaders $headers)
    {
        $this->jwt = $jwt;
        $this->parser = $parser;
        $this->headers = $headers;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $tokenString = $this->headers->parse($request);
        $tokenObj = $this->parser->parse($tokenString);
        $user = User::findOrFail($tokenObj->getClaim('sub'));

        if($user->api_key !== $tokenObj->getClaim('token')){
            return response('Unauthorized.', 401);
        }

        $user->setNewApiToken();
        return response()->json([
            'accessToken' => $this->jwt->fromUser($user),
            'refreshToken' => 'bearer',
            'tokenExpired' => $this->jwt->factory()->getTTL() * 60
        ]);
    }

}
