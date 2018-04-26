<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);

        $model = new Post();
        if($request->has('thumbnail')) $model->thumbnail = basename($request->input('thumbnail'));
        $model->title = $request->input('title');
        if($request->has('description')) $model->description = $request->input('description');
        $model->text = $request->input('text');
        $model->save();

        return response()->json($model);
    }
    public function getAll(){
        $posts = Post::all();
        foreach ($posts as &$post){ // TODO вывести в метод
            $post->thumbnail = (!empty($post->thumbnail))? url(config('store.public.thumbnails').$post->thumbnail) : url(config('store.public.uploads').'default.jpg');
        }
        return response()->json($posts);
    }
    public function read($id)
    {
        return response()->json(Post::findOrFail($id));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);
        $model = Post::findOrFail($id);
        if($request->has('thumbnail')) $model->thumbnail = basename($request->input('thumbnail'));
        $model->title = $request->input('title');
        if($request->has('description')) $model->description = $request->input('description');
        $model->text = $request->input('text');
        $model->save();


        return response()->json($model);
    }

    public function delete($id)
    {
        $category = Post::findOrFail($id);
        $category->disabled = true;

        return response()->json($category->save());
    }
}