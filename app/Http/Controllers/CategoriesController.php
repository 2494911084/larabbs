<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Request $request, Category $category)
    {
        $topics = $category->topics()->orderWith($request->order)->with('category', 'user')->paginate();
        return view('topics.index', compact('topics', 'category'));
    }
}
