<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
       return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category([
            'name' => $request->get('name'),
        ]);
        $category->save();
        return redirect('/categories')->with('success', 'Categoria criada!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories');
    }
}
