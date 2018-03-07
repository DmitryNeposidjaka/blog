<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:35
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @package App
 *
 * @property $name
 * @property $disabled
 */
class Tag extends Model
{
    protected $fillable = [
        'name',
    ];
}