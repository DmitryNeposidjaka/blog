<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 22.05.18
 * Time: 13:30
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const MAX = 'MAX';
    const MIDDLE = 'MIDDLE';
    const MIN = 'MIN';

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

    public function close(){
        $this->close = true;
        $this->save();
        return $this;
    }
}