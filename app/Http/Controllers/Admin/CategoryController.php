<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductPost;
use App\Models\ProductRequest;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
        $search_query = $request->input('search_query');
        if ($request->has('search_query') && !empty($search_query)) {
            $query->where(function ($query) use ($search_query) {
                $query->where('title', 'like', '%' . $search_query . '%');
            });
        }
        $data['categories'] = $query->orderBy('id', 'DESC')->get();
        $data['searchParams'] = $request->all();
        return view('admin/categories/manage_categories', $data);
    }

    public function store_category(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(array('msg' => 'error', 'response' => 'Invaid Category Title.'));
        }
        $category = Category::where('title', $data['title'])->first();
        if (!empty($category)) {
            return response()->json(array('msg' => 'error', 'response' => 'Category already exists.'));
        }
        $category = new Category();
        $category->title = $data['title'];
        $category->parent_id = $data['parent'];
        $category->status = 1;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/categories/');
            $image->move($destinationPath, $image_name);
            $category->image = $image_name;
        }
        $category->save();
        if ($category->id > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Category added successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }
    public function category_show(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $category = Category::where('id', $id)->first();
        $parent_categories = Category::whereNull('parent_id')->get();
        $htmlresult = view('admin/categories/edit_category_ajax', compact('category', 'parent_categories'))->render();
        $finalResult = response()->json(['msg' => 'success', 'response' => $htmlresult]);
        return $finalResult;
    }
    public function update_category(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(array('msg' => 'error', 'response' => 'Invaid Category Title.'));
        }
        $category = Category::where('title', $data['title'])->first();

        if (!empty($category) && $category->id != $data['id']) {
            return response()->json(array('msg' => 'error', 'response' => 'Category ' . $category->title . ' already exists.'));
        }
        $category = Category::where('id', $data['id'])->first();
        if ($request->hasFile('image')) {
            // delete previous image
            if ($category->image != null) {
                $image_path = public_path('/uploads/categories/' . $category->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/categories/');
            $image->move($destinationPath, $image_name);
            $category->image = $image_name;
        }
        $query = Category::where('id', $data['id'])->update([
            'title' => $data['title'],
            'parent_id' => $data['parent'],
            'image' => $category->image,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        

        if ($query) {
            $finalResult = response()->json(['msg' => 'success', 'response' => 'Category updated successfully.']);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }
    public function delete_category(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $status = Category::where('id', $data['id'])->first();
        // if category has subcategories then return error
        $subcategories = Category::where('parent_id', $data['id'])->get();
        if (count($subcategories) > 0) {
            return response()->json(array('msg' => 'error', 'response' => 'Category has sub-categories. Please delete them first.'));
        }
        // if category has products then return error
        $products = ProductPost::where('category_id', $data['id'])->get();
        if (count($products) > 0) {
            return response()->json(array('msg' => 'error', 'response' => 'Could Not Delete Category. Category has products.'));
        }

        // if category has product requests then return error
        $requests = ProductRequest::where('category_id', $data['id'])->get();
        if (count($requests) > 0) {
            return response()->json(array('msg' => 'error', 'response' => 'Could Not Delete Category. Category has product requests.'));
        }


        if($status->image != null && $status->image != 'default.png') {
            $image_path = public_path('/uploads/categories/' . $status->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $status = Category::where('id', $data['id'])->delete();
        if ($status > 0) {
            $finalResult = response()->json(['msg' => 'success', 'response' => "Category Deleted successfully."]);
            return $finalResult;
        } else {
            $finalResult = response()->json(['msg' => 'error', 'response' => 'Something went wrong!']);
            return $finalResult;
        }
    }
}
