<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Post as PostResource;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts= Post::orderBy('created_at','desc')->get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $storePost = new Post();
        $storePost->title= $request->get('title');
        $storePost->desc= $request->get('desc');
        $storePost->body= $request->get('body');
        $storePost->status= $request->get('status');
        $storePost->created_by=1;
        if($request->file('thumbnail')){
            $generatedImg = 'image'.time().'.'.$request->file('thumbnail')->extension();
            $request->file('thumbnail')->move(public_path('img'),$generatedImg);
            $storePost->thumbnail= $generatedImg;
        }
        $storePost->save();
        return response()->json($storePost,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return new PostResource($post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $updatePost = Post::find($id);
        if($updatePost){
            $updatePost->title=$request->get('title');
            $updatePost->desc=$request->get('desc');
            $updatePost->body=$request->get('body');
            $updatePost->status=$request->get('status');
            $updatePost->created_by=1;
            if($request->file('thumbnail')){
                $generatedImg = 'image'.time().'.'.$request->file('thumbnail')->extension();
                $request->file('thumbnail')->move(public_path('img'),$generatedImg);
                $updatePost->thumbnail= $generatedImg;
            }
            $updatePost->save();
        }
        return response()->json($updatePost,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        if ($post){
            $post->delete();
        }
        return response()->json('delete succsess');
    }
}
