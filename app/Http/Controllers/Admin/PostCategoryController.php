<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostCategoryController extends Controller
{
    public function assign(Request $request)
    {
        $this->validate($request, [
            'post' => 'required',
            'category' => 'required',
        ]);

        return response()->json((new PostCategory(['post_id' => $request->input('post'), 'category_id' => $request->input('category')]))->save());
    }

    public function getLinked($post, $category)
    {
        return response()->json(PostCategory::findLinking($post, $category));
    }

    public function unlink($post, $category)
    {
        $model = PostCategory::findLinking($post, $category);
        return response()->json( DB::delete("delete from {$model->getTableName()} WHERE post_id={$model->post_id} AND category_id={$model->category_id}" ));
    }
}