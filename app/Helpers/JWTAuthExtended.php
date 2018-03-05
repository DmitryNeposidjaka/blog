<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 01.03.18
 * Time: 20:21
 */

namespace App\Helpers;


use Tymon\JWTAuth\JWTAuth;

class JWTAuthExtended extends JWTAuth
{
    /**
     * Login a user via a credentials.
     *
     * @return \Tymon\JWTAuth\Contracts\JWTSubject|false
     */
    public function login($credentials)
    {
        if (! $this->auth->byCredentials($credentials)) {
            return false;
        }

        return $this->fromUser($this->user()->setNewApiToken());
    }
}