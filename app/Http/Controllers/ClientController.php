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
}