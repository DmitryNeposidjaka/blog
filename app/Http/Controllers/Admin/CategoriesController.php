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
        $model = new Category(['name' => $request->input('name')]);
        $model->save();
        return response()->json($model);
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
        $category->save();
        return response()->json($category);
    }

    public function getAll(){
        $categories = Category::all();
        return response()->json($categories);
    }
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->disabled = true;
        $category->save();
        return response()->json($category);
    }
    public function getBack($id)
    {
        $category = Category::findOrFail($id);
        $category->disabled = false;
        $category->save();
        return response()->json($category);
    }
}