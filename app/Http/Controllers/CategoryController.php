<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\GeneralSettingRepository;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        return view('category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        CategoryRepository::storeByRequest($request);
        return back()->with('success', 'Category inserted successfully');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        CategoryRepository::updateByRequest($request, $category);
        return back()->withSuccess('Category updated successfully');
    }
    public function delete(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted successfully');
    }

    public function downloadSample()
    {
        return response()->download(public_path('import/sample_category.csv'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv'
        ]);
        $file = $request->file('file');
        $csvData = array_map('str_getcsv', file($file));
        try {
            foreach ($csvData as $key => $row) {
                if ($key > 0) {
                    $category = CategoryRepository::query()->where('name', $row[1])->first();
                    Category::create([
                        'created_by' => auth()->id(),
                        'shop_id' => $this->mainShop()->id,
                        'name' => $row[0],
                        'parent_id' => $category?->id,
                    ]);
                }
            }
            return back()->with('success', 'Categories import successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Please provide valid data in the csv file!');
        }
    }

    public function categoryPrint(Request $request)
    {
        $categories = CategoryRepository::query()->limit($request->length)->get();
        $generalsettings = GeneralSettingRepository::query()->where('shop_id', $this->mainShop()->id)->first();
        return view('category.categoryPrint', compact('categories', 'generalsettings'));
    }
}
