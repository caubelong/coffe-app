<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Requests\ProductValidated;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::orderBy('created_at','desc')->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidated $request)
    {
        $request->validated();
        $newProduct = new Product();
        $newProduct->name=$request->get('name');
        $newProduct->price=$request->get('price');
        $newProduct->discount=$request->get('discount');
        $newProduct->status=$request->get('status');
        $newProduct->desc=$request->get('desc');
        $newProduct->cate_id=$request->get('cate_id');
        $newProduct->created_by=1;
        if($request->file('thumbnail')){
            $generatedImg = 'image'.time().'.'.$request->file('thumbnail')->extension();
            $request->file('thumbnail')->move(public_path('img'),$generatedImg);
            $newProduct->thumbnail= $generatedImg;
        }
        $newProduct->save();
        return response()->json($newProduct,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductValidated $request, $id)
    {
        //
        $updateProduct = Product::find($id);
        $request->validated();
        if ($updateProduct){
            $updateProduct->name=$request->get('name');
            $updateProduct->price=$request->get('price');
            $updateProduct->discount=$request->get('discount');
            $updateProduct->status=$request->get('status');
            $updateProduct->desc=$request->get('desc');
            $updateProduct->cate_id=$request->get('cate_id');
            $updateProduct->created_by=1;
            if($request->file('thumbnail')){
                $generatedImg = 'image'.time().'.'.$request->file('thumbnail')->extension();
                $request->file('thumbnail')->move(public_path('img'),$generatedImg);
                $updateProduct->thumbnail= $generatedImg;
            }
            $updateProduct->save();
        }
        return response()->json($updateProduct,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return response()->json('delete success',200);
    }
}
