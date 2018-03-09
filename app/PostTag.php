<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:35
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Category
 *
 * @package App
 * @property $name
 * @property $disabled
 */
class PostTag extends Model
{
    protected $table = 'post_tag';

    protected $primaryKey = "post_id";
    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    public $timestamps = false;

    public static function findLinking($post_id, $tag_id){
        if ($result = self::where(['post_id' => $post_id, 'tag_id' => $tag_id])->first()) {
            return $result;
        } else {
            abort(404, 'Data not found');
        }
    }

    public function getTableName(){
        return DB::getTablePrefix().$this->table;
    }
}