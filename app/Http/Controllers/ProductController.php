<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): view
    {

        // die();
        // $product_list = Product::with('category')->get();
        // return $product_list;
        // return view('product.index', compact('product_list'));
        return view('product.index', [
            'product_list' => Product::with('category')->get(),
        ]);
        // return view('product.index');
    }

    public function index_api()
    {
        $product_list = Product::with('category')->get();
        return $product_list;

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): view
    {
        // $category = ProductCategory::get();
        // return $category;
        // return view('product.create', [
        //     'category' => $category
        // ]);
        return view('product.create');
    }
    public function create_api()
    {
        $category = ProductCategory::get();
        return $category;
        // return view('product.create', [
        //     'category' => $category
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|max:100',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|max:100'
        // ]);

        $validator = $request->validate([
            'name' => 'required|max:100',
            'category_id' => 'required|integer',
            'description' => 'required|max:100'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product_list = Product::with('category')->get();
        dd($product_list);
        die();
        return ['product_list' => $product_list];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product): view
    {
        return view('product.edit');
    }

    public function edit_api($productId)
    {
        // echo "<pre>" . print_r($productId, 1) . "</pre>";
        $product = Product::find($productId);
        // echo "<pre>" . print_r($product, 1) . "</pre>";
        // die();
        if ($product) {
            return $product;
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records found!',
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId)
    {


        $validator = $request->validate([
            'name' => 'required|max:100',
            'category_id' => 'required|integer',
            'description' => 'required|max:100'
        ]);

        $product = Product::find($productId);
        if ($product) {
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->update();
            return response()->json([
                'status' => 200,
                'message' => 'Product updated!',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Product is now deleted!',
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Records found!',
            ], 404);
        }
    }
}
