<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 16:50
 */

namespace App\Http\Controllers\Admin;


use App\Achieve;
use App\Http\Controllers\Controller;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
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
            'important' => 'required',
        ]);

        $model = new Task();
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->important = $request->input('important');
        $model->creator = $this->user->id;
        $model->executor = $request->has('executor')? $request->input('important'): $this->user->id;
        $model->assigned_at = $request->has('assigned_at')? Carbon::parse($request->input('assigned_at'))->timestamp: null;
        $model->save();
    }

    public function read($id){
        $model = Task::findOrFail($id);
        return response()->json($model);
    }

    public function update($id, Request $request){
        $model = Task::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->important = $request->input('important');
        $model->executor = $request->has('executor')? $request->input('important'): $this->user->id;
        $model->assigned_at = $request->has('assigned_at')? Carbon::parse($request->input('assigned_at'))->timestamp: null;
        $model->save();
        return response()->json($model);
    }

    public function delete($id){
        $model = Task::findOrFail($id);
        $model->disabled = true;
        $model->save();
        return response()->json($model);
    }

    public function getAll($user){
        if(isset($user)){
            $user = User::findOrFail($user);
            $model = Task::where(['creator' => $user->id])->get();
        }else{
            $model = Task::where(['creator' => $user->id])->get();
        }

        return response()->json($model);
    }

    public function close($id){
        $model = Task::findOrFail($id);
        $closed = $model->close();
        $achive = new Achieve();
        $achive->title = $closed->title;
        $achive->description = $closed->description;
        $achive->creator = $closed->creator;
        $achive->task = $closed->id;
        $achive->save();
        return response()->json($closed);
    }

    public function getBack($id){
        $model = Task::findOrFail($id);
        $model->disabled = false;
        $model->save();
        return response()->json($model);
    }
}