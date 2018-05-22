<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 13:34
 */

namespace App;


class Achieve
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function getCreator(){
        return $this->hasOne(User::class, 'creator', 'id');
    }

    public function getTask(){
        return $this->hasOne(Task::class, 'task', 'id');
    }
}