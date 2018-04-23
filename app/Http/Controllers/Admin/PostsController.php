<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;


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

        return response()->json((new Post(['title' => $request->input('title'),'text' => $request->input('text')]))->save());
    }
    public function getAll(){
        return response()->json(Post::all());
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
        $category = Post::findOrFail($id);
        $category->title = $request->input('title');
        $category->text = $request->input('text');

        return response()->json($category->save());
    }

    public function delete($id)
    {
        $category = Post::findOrFail($id);
        $category->disabled = true;

        return response()->json($category->save());
    }
}