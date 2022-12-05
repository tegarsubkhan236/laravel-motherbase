<?php

namespace Modules\Blog\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $data = BlogCategory::with('children')->where('parentId', null)->get();
        return view('blog::pages.category.index', [
            'data' => $data,
            'title' => 'Blog Category'
        ]);
    }

    public function create()
    {
        return view('blog::pages.category.form',[
            'title' => 'Blog Category',
            'parents' => BlogCategory::query()->where('parentID', null)->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'parent_id' => 'required'
        ]);
        try {
            BlogCategory::query()->create([
                'title' => $request['name'],
                'parentId' => $request['parent_id'] != "0" ? $request['parent_id'] : null,
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('blog.category.index')->with('success', 'data created successfully');
    }

    public function show()
    {
        return view('blog::show');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('blog::pages.category.form', [
            'item' => $blogCategory,
            'parents' => BlogCategory::query()->whereNull('parentId')->get(),
            'title' => 'Blog Category'
        ]);
    }

    public function update(BlogCategory $blogCategory, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => "required|string|unique:permissions,name,$blogCategory->id,id",
            'parent_id' => 'nullable'
        ]);
        try {
            $blogCategory->update([
                'title' => $request['name'],
                'parentId' => $request['parent_id'] != 0 ? $request['parent_id'] : null
            ]);
        } catch (Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
        return redirect()->route('blog.category.index')->with('success', 'Data updated successfully');
    }

    public function delete(BlogCategory $blogCategory): RedirectResponse
    {
        try {
            $blogCategory->delete();
        } catch (Exception $e) {
            return back()->withErrors(['error' => "something wrong on function"]);
        }
        return back()->with(['success' => "data has been deleted"]);
    }
}
