<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('title', 'like', '%' . $search_query . '%');
            });
        }
        $data['blogs'] = $query->orderBy('id', 'DESC')->get();
        $data['searchParams'] = $request->all();
        return view('admin/blogs/manage_blogs', $data);
    }
    public function add_blog()
    {
        return view('admin/blogs/add_blog');
    }
    public function store_blog(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/blogs/add')
                ->withErrors($validator)
                ->withInput();
        }
        $image_name = 'blog.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/blogs');
            $image->move($destinationPath, $image_name);
        }
        $blog = new Blog();
        $blog->image = $image_name;
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->status = 1;
        $blog->save();

        if ($blog) {
            return redirect('admin/blogs')->with('success', 'Blog added successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function delete_blog(Request $request)
    {
        $data = $request->all();
        $blog = Blog::where('id', $data['id'])->first();
        if ($blog) {
            if (file_exists(public_path('uploads/blogs/' . $blog->image)) && $blog->image != 'blog.png') {
                unlink(public_path('uploads/blogs/' . $blog->image));
            }
            $status = $blog->delete();
            if ($status > 0) {
                $finalResult = response()->json(['msg' => 'success', 'response' => "Blog Deleted successfully."]);
                return $finalResult;
            } else {
                $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
                return $finalResult;
            }
        } else {
            session()->flash('error', 'Blog not found.');
            return redirect()->back();
        }
    }

    public function blog_show($id)
    {
        $blog = Blog::where('id', $id)->first();
        if ($blog) {
            return view('admin/blogs/edit_blog', compact('blog'));
        } else {
            session()->flash('error', 'Blog not found.');
            return redirect()->back();
        }
    }

    public function update_blog(Request $request)
    {
        // dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'Please fill all the required fields.');
            return redirect()->back();
        }

        $blog = Blog::where('id', $request->input('id'))->first();

        if ($blog) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/blogs');
                $image->move($destinationPath, $image_name);
                // delete old image if any
                if (file_exists(public_path('uploads/blogs/' . $blog->image)) && $blog->image != 'blog.png') {
                    unlink(public_path('uploads/blogs/' . $blog->image));
                }
                $blog->image = $image_name;
            }
            $blog->title = $request->input('title');
            $blog->description = $request->input('description');
            $request->has('status') ? $blog->status = 1 : $blog->status = 0;
            $blog->save();

            return redirect('admin/blogs')->with('success', 'Blog updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
