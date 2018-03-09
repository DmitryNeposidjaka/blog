<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostTagController extends Controller
{
    public function assign(Request $request)
    {
        $this->validate($request, [
            'post' => 'required',
            'tag' => 'required',
        ]);

        return response()->json((new PostTag(['post_id' => $request->input('post'), 'tag_id' => $request->input('tag')]))->save());
    }

    public function getLinked($post, $tag)
    {
        return response()->json(PostTag::findLinking($post, $tag));
    }

    public function unlink($post, $tag)
    {
        $model = PostTag::findLinking($post, $tag);
        return response()->json( DB::delete("delete from {$model->getTableName()} WHERE post_id={$model->post_id} AND tag_id={$model->tag_id}" ));
    }
}