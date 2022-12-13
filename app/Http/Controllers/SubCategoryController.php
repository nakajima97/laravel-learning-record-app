<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function create()
    {
        $categories = MainCategory::where('user_id', Auth::id())->get();

        return view('sub_categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $sub_category = new SubCategory();

        $sub_category->fill($request->all());

        $sub_category->save();

        return redirect()->route('categories.index');
    }
}
