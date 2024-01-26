<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class BlogController extends Controller
{
    protected $guard = 'api';

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        // $blogs = Blog::all(); where status = 1
        $blogs = Blog::where('status', 1)->orderBy('id', 'desc')->paginate(10);
        foreach($blogs as $blog){
            $blog->image = asset('uploads/blogs/'.$blog->image);
        }
        return response()->json([
            'success' => true,
            'message' => 'Blogs fetched successfully',
            'data' => $blogs
        ]);
    }

    public function show($id){
        $blog = Blog::find($id);
        if(!$blog){
            return response()->json([
                'success' => false,
                'message' => 'Blog not found'
            ]);
        }
        
        $blog->image = asset('uploads/blogs/'.$blog->image);
        return response()->json([
            'success' => true,
            'message' => 'Blog fetched successfully',
            'data' => $blog
        ]);
    }
}
