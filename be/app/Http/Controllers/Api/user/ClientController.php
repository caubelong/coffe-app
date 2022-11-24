<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Post as PostResource;
class ClientController extends Controller
{
    //
    public function index()
    {
        //
        $products = Product::orderBy('created_at','desc')->get();
        return ProductResource::collection($products);
    }
    public function getProductByCategory(){
        $categories = Category::all();
        //$product = $category->product();
        $productIsGetCategory = array();
        foreach ($categories as $category){
           array_push( $productIsGetCategory,[[$category->name],ProductResource::collection($category->product->where('status','=',1))]);
        }
        return response()->json($productIsGetCategory,200);
    }
    public function getProductInfoById(Product $product){
        return new ProductResource($product);
    }
    public function getProductRelated($productId,$cate_id){
        $productRelated = Product::where('cate_id','=',$cate_id)
            ->where('id','!=',$productId)
            ->orderBy('name')
            ->take(5)->get();
        return ProductResource::collection($productRelated);
    }
    public function getPostSlider(){
        $postSlider = Post::orderBy('created_at','desc')->take(5)->get();
        return PostResource::collection($postSlider);
    }
    public function getPostDetail(Post $post){
        return new PostResource($post);
    }
   public function getPostRelatedList($post){
       $postRelated = Post::where('id','!=',$post)
           ->orderBy('created_at','desc')
           ->take(4)->get();
        return PostResource::collection($postRelated);
   }
   public function getPostList(){
        $postList = Post::orderBy('created_at','desc')->get();
        return PostResource::collection($postList);
   }
}
