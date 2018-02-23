<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 23.02.18
 * Time: 18:40
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class AuthController
{
    /**
     * @var Guard
     */
    private $guard;

    /**
     * @var UserProvider
     */
    private $provider;

    public function __construct()
    {
        $this->guard = app('auth');

        $this->provider = $this->guard->getProvider();
    }

    public function login(Request $request){
        if ($this->guard->validate($request->only('login', 'password'))) {
            $user = $this->provider->retrieveByCredentials($request->all());
        }
        print_r($request);


        ;
    }
}