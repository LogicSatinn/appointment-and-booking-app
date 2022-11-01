<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Error;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::with('createdBy')->get();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * @param  CategoryStoreRequest  $request
     * @return RedirectResponse
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            Category::create($request->validated());

            toast('Category saved successfully', 'success');

            return redirect()->route('categories.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. We are working to fix this.', 'error');

            return back();
        }
    }

//    /**
//     * @param Category $category
//     * @return Application|Factory|View
//     */
//    public function show(Category $category)
//    {
//        return view('admin.category.show', compact('category'));
//    }

    /**
     * @param  CategoryUpdateRequest  $request
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());

            toast('Category updated successfully.', 'success');

            return redirect()->route('categories.index');
        } catch (Exception|Error) {
            toast('Something went really wrong. We are working to fix this.', 'error');

            return back();
        }
    }

    /**
     * @param  Category  $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            toast('Category deleted successfully.', 'success');

            return redirect()->route('categories.index');
        } catch (Exception|Error) {
            toast('Something went exceptionally wrong. We will fix this.', 'error');

            return back();
        }
    }
}
