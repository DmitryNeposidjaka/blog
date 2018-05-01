<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;

use App\PostCategory;
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
        if($request->has('categories')){
            foreach (explode(',', $request->input('categories')) as $category){
                (new PostCategory(['post_id' => $model->id, 'category_id' => $category]))->save();
            }
        }
        return response()->json($model);
    }
    public function getAll(){
        $posts = Post::with('categories')->get();
        foreach ($posts as &$post){ // TODO вывести в метод
            $post->thumbnail = (!empty($post->thumbnail))? url(config('store.public.thumbnails').$post->thumbnail) : url(config('store.public.uploads').'default.jpg');
            $categories = $post->categories->toArray();
            unset($post->categories);
            $post->categories = array_column($categories, 'category_id');
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
        if($request->has('categories')){
            $categories = PostCategory::where('post_id', $model->id)->get();
            $delete = array_diff(array_column($categories->toArray(), 'category_id'), explode(',', $request->input('categories')));
            PostCategory::whereIn('category_id',$delete)->delete();
            foreach (array_diff(explode(',', $request->input('categories')), array_column($categories->toArray(), 'category_id')) as $category){
                (new PostCategory(['post_id' => $model->id, 'category_id' => $category]))->save();
            }
        }
        $model->save();

        return response()->json($model);
    }

    public function delete($id)
    {
        $category = Post::findOrFail($id);
        $category->disabled = true;
        $category->save();
        return response()->json($category);
    }

    public function getBack($id)
    {
        $category = Post::findOrFail($id);
        $category->disabled = false;
        $category->save();
        return response()->json($category);
    }
}