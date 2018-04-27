<?php
/**
 * Created by PhpStorm.
 * User: dima
 * Date: 07.03.18
 * Time: 18:28
 */

namespace App\Http\Controllers\Admin;


use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        return response()->json((new Category(['name' => $request->input('name')]))->save());
    }

    public function read($id)
    {
        return response()->json(Category::findOrFail($id));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');

        return response()->json($category->save());
    }

    public function getAll(){
        $categories = Category::all();
        return response()->json($categories);
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->disabled = true;

        return response()->json($category->save());
    }
}