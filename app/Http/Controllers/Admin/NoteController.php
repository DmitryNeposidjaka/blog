<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 16:51
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Note;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function create(Request $request){
        $this->validate($request, [
            'title' => 'required',
        ]);

        $model = new Note();
        $model->title = $request->input('title');
        $model->creator = $this->user->id;
        $model->save();
        return response()->json($model);
    }

    public function read($id){
        $model = Note::findOrFail($id);
        return response()->json($model);
    }

    public function update($id, Request $request){
        $model = Note::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
        ]);
        $model->title = $request->input('title');
        $model->save();
        return response()->json($model);
    }

    public function delete($id){
        $model = Note::findOrFail($id);
        $model->disabled = true;
        $model->save();
        return response()->json($model);
    }

    public function getAll($user = null){
        if(!empty($user)){
            $user = User::findOrFail($user);
            $model = Note::where(['creator' => $user->id])->get();
        }else{
            $model = Note::where(['creator' => $this->user->id])->get();
        }

        return response()->json($model);
    }

    public function getBack($id){
        $model = Note::findOrFail($id);
        $model->disabled = false;
        $model->save();
        return response()->json($model);
    }
}