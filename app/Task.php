<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 13:30
 */

namespace App;


class Task
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function getCreator(){
        return $this->hasOne(User::class, 'creator', 'id');
    }
    public function getExecutor(){
        return $this->hasOne(User::class, 'executor', 'id');
    }
}