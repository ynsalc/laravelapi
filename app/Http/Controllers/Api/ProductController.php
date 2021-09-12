<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Product::all();
        /*return response()->json([
            'success' => 'true',
            'data' => Product::all()
        ], 200);*/
        //return response(Product::paginate(5), 200);
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 5;

        $qb = Product::query()->with('categories');
        if($request->has('q'))
            $qb->where('name','like','%' . $request->query('q') . '%');

        if($request->has('sortBy'))
            $qb->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));

        $data = $qb->offset($offset)->limit($limit)->get();

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
        /*
         * $product = new Product;
         * $product->name = $request->name;
         * $product->slug = $request->slug;
         * $product->price = $request->price;
         * $product->save();
         * */
        $product = Product::create($input);
        return response([
            'data' => $product,
            'message' => 'Product Created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if($product)
            return response($product, 200);
        else
            return response(['message' => 'Product Not Found !'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        /*
         * $product->name = $request->name;
         * $product->slug = $request->slug;
         * $product->price = $request->price;
         * $product->save();
         * */
        $product->update($input);
        return response([
            'data' => $product,
            'message' => 'Product updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            'message' => 'Product deleted'
        ]);
    }

    public function custom()
    {
        return Product::select('id as product_id','name as product_name')
            ->orderBy('created_at', 'DESC')->take(10)->get();
        //return Product::select('id','name','price')->orderBy('created_at', 'DESC')->take(10)->get();
    }
}
