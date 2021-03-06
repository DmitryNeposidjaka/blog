<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 08.06.18
 * Time: 19:42
 */

namespace App\Helpers;


use App\Task;

class TaskHelper
{
    public static function setTags(Task $model, $data){
        $data_arr = explode(',', $data);
        foreach ($data_arr as $tag){
            $model->tags()->attach($tag);
        }
    }

    public static function updateTags(Task $model, $data){
        $data_arr = explode(',', $data);
        $tags = $model->tags;
        $delete = array_diff(array_column($tags->toArray(), 'id'), $data_arr);

        $model->tags()->detach($delete);
        foreach (array_diff($data_arr, array_column($tags->toArray(), 'id')) as $tag){
            $model->tags()->attach($tag);
        }
    }
}