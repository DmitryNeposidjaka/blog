<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 02.05.18
 * Time: 11:34
 */

namespace App\Helpers;


use App\Post;
use App\PostCategory;
use App\PostTag;

class PostHelper
{
    public static function setCategories(Post $model, $data){
        $data_arr = explode(',', $data);
        foreach ($data_arr as $category){
            (new PostCategory(['post_id' => $model->id, 'category_id' => $category]))->save();
        }
    }
    public static function updateCategories(Post $model, $data){
        $data_arr = explode(',', $data);
        $categories = PostCategory::where('post_id', $model->id)->get();
        $delete = array_diff(array_column($categories->toArray(), 'category_id'), $data_arr);
        PostCategory::whereIn('category_id',$delete)->delete();
        foreach (array_diff($data_arr, array_column($categories->toArray(), 'category_id')) as $category){
            (new PostCategory(['post_id' => $model->id, 'category_id' => $category]))->save();
        }
    }
    public static function setTags(Post $model, $data){
        $data_arr = explode(',', $data);
        foreach ($data_arr as $tag){
            (new PostTag(['post_id' => $model->id, 'tag_id' => $tag]))->save();
        }
    }
    public static function updateTags(Post $model, $data){
        $data_arr = explode(',', $data);
        $tags = PostTag::where('post_id', $model->id)->get();
        $delete = array_diff(array_column($tags->toArray(), 'tag_id'), $data_arr);
        PostTag::whereIn('tag_id',$delete)->delete();
        foreach (array_diff($data_arr, array_column($tags->toArray(), 'tag_id')) as $tag){
            (new PostTag(['post_id' => $model->id, 'tag_id' => $tag]))->save();
        }
    }
}