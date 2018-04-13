<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 30.03.18
 * Time: 17:23
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class UserController extends \App\Http\Controllers\Controller
{
    public function read(Request $request){

        return $request->user()->toJson();
    }
}