<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 13:30
 */

namespace App\Providers;


use App\User;

class Note
{
    const MAX = 'MAX';
    const MIDDLE = 'MIDDLE';
    const MIN = 'MIN';

    protected $fillable = [
        'title',
    ];

    public function getCreator(){
        return $this->hasOne(User::class, 'creator', 'id');
    }
}