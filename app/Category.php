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
 * Class Category
 *
 * @package App
 * @property $name
 * @property $disabled
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];
}