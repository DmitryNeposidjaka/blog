<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 13:30
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title',
    ];

    public function getCreator(){
        return $this->hasOne(User::class, 'creator', 'id');
    }
}