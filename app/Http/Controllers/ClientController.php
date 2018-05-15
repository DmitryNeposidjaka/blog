<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 04.05.18
 * Time: 12:59
 */

namespace App\Http\Controllers;


use App\Category;
use App\Post;
use App\Tag;

class ClientController extends Controller
{
    public function getPosts(){
        $posts = Post::with(['categories', 'tags'])->where('disabled', 0)->get();
        foreach ($posts as &$post){ // TODO вывести в метод
            $post->thumbnail = (!empty($post->thumbnail))? url(config('store.public.thumbnails').$post->thumbnail) : url(config('store.public.uploads').'default.jpg');
        }
        return response()->json($posts);
    }

    public function getCategories(){
        $categories = Category::where('disabled', 0)->get();

        return response()->json($categories);
    }

    public function getPost($id){
        $post = Post::with(['categories', 'tags'])->where(['disabled' => 0, 'id' => $id])->first();
        $tags = [];
        foreach ($post->tags as $tag){
            $tagModel = Tag::findOrFail($tag->tag_id);
            $tags[] = [
                'id' => $tagModel->id,
                'name' => $tagModel->name,
            ];
            unset($tagModel);
        }
        unset($post->tags);
        $post->tags = $tags;
        $post->thumbnail = (!empty($post->thumbnail))? url(config('store.public.thumbnails').$post->thumbnail) : url(config('store.public.uploads').'default.jpg');
        return response()->json($post);
    }
}