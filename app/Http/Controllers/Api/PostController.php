<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        //get all posts
        $posts = Post::with('user')->paginate(5);
        // $posts['author'] = Post::with('user')->get();

        //return collection of posts as a resource
       return response()->json([
            'code' => '200',
            'message' => 'Success',
            'data' => $posts,
        ]);
    }

     public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
        'title'       => 'required|string|max:255',
        'content'     => 'required|string',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create Post
       $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
        ]);

        //return success response
        return response()->json([
            'code' => '200',
            'message' => 'Post created successfully',
            'data' => $post,
        ]);
 
}

     public function show($id)
    {
        //find post by ID
        $post = Post::find($id);

        // Check if post doesn't exist
        if (is_null($post)) {
            return response()->json([
                'code' => '404',
                'message' => 'Post not found',
                'data' => null,
            ]);
        }

        //return single post as a resource
        return response()->json([
            'code' => '200',
            'message' => 'Post retrieved successfully',
            'data' => $post,
        ]);
}
    
 public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

       
        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $post = Post::find($id);

      
        // check if the post still available
        if (is_null($post)) {
          abort(404);
        }
    
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        

        //return response
     return response()->json([
            'code' => '200',
            'message' => 'Post updated successfully',
            'data' => $post,
        ]);
    }
    
         public function destroy($id)
        {
            //find post by ID
            $post = Post::find($id);
    
            // Check if post doesn't exist
            if (is_null($post)) {
               abort(404);
            }
    
            //delete post
            $post->delete();
    
            //return success response
            return response()->json([
                'code' => '200',
                'message' => 'Post deleted successfully',
                'data' => null,
            ]);
        }
}