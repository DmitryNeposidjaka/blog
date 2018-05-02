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
use App\Helpers\PostHelper;

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
        if($request->has('categories')) PostHelper::setCategories($model, $request->input('categories'));
        if($request->has('tags')) PostHelper::setTags($model, $request->input('tags'));
        return response()->json($model);
    }
    public function getAll(){
        $posts = Post::with(['categories', 'tags'])->get();
        foreach ($posts as &$post){ // TODO вывести в метод
            $post->thumbnail = (!empty($post->thumbnail))? url(config('store.public.thumbnails').$post->thumbnail) : url(config('store.public.uploads').'default.jpg');
            $categories = $post->categories->toArray();
            unset($post->categories);
            $post->categories = array_column($categories, 'category_id');
            $tags = $post->tags->toArray();
            unset($post->tags);
            $post->tags = array_column($tags, 'tag_id');
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
        if($request->has('categories')) PostHelper::updateCategories($model, $request->input('categories'));
        if($request->has('tags')) PostHelper::updateTags($model, $request->input('tags'));

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