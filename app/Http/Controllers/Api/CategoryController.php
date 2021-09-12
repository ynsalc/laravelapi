<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qb = Category::query()->with('products');
        $data = $qb->get();
        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $category = Category::create($input);
        return response([
            'success'=>'true',
            'message' => 'Category Created',
            'data'=>$category
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $category->update($input);
        return response([
            'success' => 'true',
            'message' => 'Category Updated',
            'data' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response([
            'success' => 'true',
            'message' => 'Category Deleted'
        ], 200);
    }

    public function custom()
    {
        return Category::pluck('name','id');
    }

    public function report()
    {
        return DB::table('product_categories as pc')
                ->select('c.name, COUNT(*) as total')
                ->join('categories as c', 'c.id', '=', 'pc.category_id')
                ->join('products as p', 'p.id', '=', 'pc.product_id')
                ->groupBy('c.name')
                ->orderByRaw('COUNT(*) DESC')
                ->get();
    }
}
