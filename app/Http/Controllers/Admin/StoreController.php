<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 26.04.18
 * Time: 16:31
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function postThumbnail(Request $request){
        $this->validate($request, [
            'thumbnail' => 'required',
        ]);
        $request->file('thumbnail')->move(config('store.thumbnails'), $request->file('thumbnail')->getClientOriginalName());
        return $request->file('thumbnail')->getClientOriginalName();
    }
}