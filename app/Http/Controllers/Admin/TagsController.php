<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model = new Tag(['name' => $request->input('name')]);
        $model->save();
        return response()->json($model);
    }

    public function read($id)
    {
        return response()->json(Tag::findOrFail($id));
    }

    public function getAll()
    {
        return response()->json(Tag::all());
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $tag = Tag::findOrFail($id);
        $tag->name = $request->input('name');
        $tag->save();
        return response()->json($tag);
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->disabled = true;
        $tag->save();
        return response()->json($tag);
    }

    public function getBack($id)
    {
        $category = Tag::findOrFail($id);
        $category->disabled = false;
        $category->save();
        return response()->json($category);
    }
}