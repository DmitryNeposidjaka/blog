<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 16:50
 */

namespace App\Http\Controllers\Admin;


use App\Achieve;
use App\Helpers\TaskHelper;
use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $model->unlimited = $request->input('unlimited')? 1 : 0;
        $model->creator = $this->user->id;
        $model->executor = $request->has('executor')? $request->input('executor'): $this->user->id;
        $model->assigned_at = $request->has('assigned_at') && $request->input('assigned_at') != null ? Carbon::parse($request->input('assigned_at'))->timestamp: null;
        $model->save();
        if($request->has('tags')) TaskHelper::setTags($model, $request->input('tags'));
        return response()->json(Task::findOrFail($model->id));
    }

    public function read($id){
        $model = Task::findOrFail($id);
        return response()->json($model);
    }

    public function update($id, Request $request){
        $model = Task::with('tags')->where(['id' => $id])->first();
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->important = $request->input('important');
        $model->unlimited = $request->input('unlimited')? 1 : 0;
        $model->executor = $request->has('executor')? $request->input('important'): $this->user->id;
        $model->assigned_at = $request->has('assigned_at')? Carbon::parse($request->input('assigned_at'))->timestamp: null;
        $model->save();
        if($request->has('tags')) TaskHelper::updateTags($model, $request->input('tags'));
        return response()->json(Task::with('tags')->where(['id' => $id])->first());
    }

    public function delete($id){
        $model = Task::findOrFail($id);
        $model->disabled = true;
        $model->save();
        return response()->json($model);
    }

    public function getAll($user = null){
        if(!empty($user)){
            $user = User::findOrFail($user);
            $model = Task::with('tags')->where(['creator' => $user->id])->get();
        }else{
            $model = Task::with('tags')->where(['creator' => $this->user->id])->get();
        }

        return response()->json($model);
    }

    public function pager(Request $request){
        if(!empty($request->has('user'))){
            $user = User::findOrFail($request->input('user'));
            $model = Task::with('tags')->where(['creator' => $user->id])->paginate(20);
        }else{
            $model = Task::with('tags')->where(['creator' => $this->user->id])->paginate(20);
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