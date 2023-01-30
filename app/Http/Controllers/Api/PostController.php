<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        //without resource
       // $posts=Post::all();


        //with resource
        $posts= PostResource::collection(Post::get());
        return $this->apiResponse($posts,'ok',200);
    }



    public function showPost($id){
        //without resource
       // $post=Post::find($id);


        //with resource ....

        //$post=new PostResource(Post::find($id));     ---> this will not make the else statement
        //OR   ---> this will make else stmt
        $post=Post::find($id);
        if($post){
            return $this->apiResponse(new PostResource($post),'ok',200);

        }
        return $this->apiResponse(null,'post not found',401);

    }




    public function store(Request $r){
       $post=Post::create($r->all());


        if($post){
            return $this->apiResponse(new PostResource($post),'ok',200);
        }
        return $this->apiResponse(null,'post has not  saved,400');
    }




public function update(Request $r,$id){
        $post=Post::find($id);
        if(!$post){
            return $this->apiResponse(null,'Not found',404);
        }

        $post->update($r->all());
        if($post){
            return $this->apiResponse(new PostResource($post),'ok',200);

        }

}



public function destroy($id){
        $post=Post::find($id);
        if(!$post){
            return $this->apiResponse(null,'Not found',404);

        }
        $post->delete();
        if($post){
            return $this->apiResponse(null,'deleted',201);

        }
}


}
