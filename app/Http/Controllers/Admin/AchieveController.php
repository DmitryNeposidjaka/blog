<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 16:51
 */

namespace App\Http\Controllers\Admin;


use App\Achieve;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Tests\Controller;

class AchieveController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function create(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $model = new Achieve();
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->creator = $this->user->id;
        $model->save();
    }

    public function read($id){
        $model = Achieve::findOrFail($id);
        return response()->json($model);
    }

    public function update($id, Request $request){
        $model = Achieve::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->save();
        return response()->json($model);
    }

    public function delete($id){
        $model = Achieve::findOrFail($id);
        $model->disabled = true;
        $model->save();
        return response()->json($model);
    }

    public function getAll($user){
        if(isset($user)){
            $user = User::findOrFail($user);
            $model = Achieve::where(['creator' => $user->id])->get();
        }else{
            $model = Achieve::where(['creator' => $user->id])->get();
        }

        return response()->json($model);
    }

    public function getBack($id){
        $model = Achieve::findOrFail($id);
        $model->disabled = false;
        $model->save();
        return response()->json($model);
    }
}