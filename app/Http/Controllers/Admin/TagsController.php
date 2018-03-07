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

        return response()->json((new Tag(['name' => $request->input('name')]))->save());
    }

    public function read($id)
    {
        return response()->json(Tag::findOrFail($id));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $tag = Tag::findOrFail($id);
        $tag->name = $request->input('name');

        return response()->json($tag->save());
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->disabled = true;

        return response()->json($tag->save());
    }
}