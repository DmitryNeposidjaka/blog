<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\NoteTag;
use Illuminate\Http\Request;

class NoteTagsController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $model = new NoteTag(['name' => $request->input('name')]);
        $model->save();
        return response()->json($model);
    }

    public function read($id)
    {
        return response()->json(NoteTag::findOrFail($id));
    }

    public function getAll()
    {
        return response()->json(NoteTag::all());
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $tag = NoteTag::findOrFail($id);
        $tag->name = $request->input('name');
        $tag->save();
        return response()->json($tag);
    }

    public function delete($id)
    {
        $tag = NoteTag::findOrFail($id);
        $tag->disabled = true;
        $tag->save();
        return response()->json($tag);
    }

    public function getBack($id)
    {
        $category = NoteTag::findOrFail($id);
        $category->disabled = false;
        $category->save();
        return response()->json($category);
    }
}