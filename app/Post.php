<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:35
 */

namespace App;

use App\PostCategory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @package App
 *
 * @property $name
 * @property $disabled
 */
class Post extends Model
{
    protected $fillable = [
        'title',
        'text',
    ];

    public function categories(){
        return $this->hasMany(PostCategory::class, 'post_id', 'id');
    }
    public function tags(){
        return $this->hasMany(PostTag::class, 'post_id', 'id');
    }

}