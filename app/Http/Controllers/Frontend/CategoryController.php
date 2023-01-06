<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;

class CategoryController extends Controller
{
    public function index(): string
    {
        $categories=Catagory::all();
        return  view('categories.index',compact('categories'));
    }

    public function show(Catagory $category): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('categories.show',compact('category'));
    }
}
