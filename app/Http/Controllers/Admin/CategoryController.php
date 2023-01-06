<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Catagory;
use http\Env\Url;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $categories = Catagory::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $image = $request->file('image')->store('public/categories');

        Catagory::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => $image,
        ]);

        return to_route('admin.categories.index')->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Catagory $category
     * @return Application|Factory|View
     */
    public function edit(Catagory $category): View|Factory|Application
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Catagory $category
     * @return RedirectResponse
     */
    public function update(Request $request, Catagory $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $image = $category->image;
        if ($request->hasFile('image')) {
            !is_null($category->image) && Storage::delete($category->image);
            $image = $request->file('image')->store('public/categories');
        }

        $category->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => $image,

        ]);

        return to_route('admin.categories.index')->with('success', 'Category Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Catagory $category
     * @return RedirectResponse
     */
    public function destroy(Catagory $category): RedirectResponse
    {
        !is_null($category->image) && Storage::delete($category->image);
        $category->menus()->detach();
        $category->delete();
        return to_route('admin.categories.index')->with('danger', 'Category Deleted Successfully');
    }
}
