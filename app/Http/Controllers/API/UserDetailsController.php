<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductPost;
use App\Models\ProductRequest;

class UserDetailsController extends Controller
{
    protected $guard = 'api';

    public function __construct()
    {
        $this->middleware('auth:api');
    }   

    public function index($id){
        $user = User::find($id);
        if($user){
            $posts = ProductPost::where('status', 1)
            ->where('vendor_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
            $posts = $this->addInformationPosts($posts);
            $requests = ProductRequest::where('status', 1)
            ->where('vendor_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();
            $requests = $this->addInformationRequests($requests);

            $all = $posts->merge($requests)->sortByDesc('created_at')->values()->all();
            return response()->json(['success' => true, 'message' => 'User Data Success', 'user' => $user, 'posts' => $posts, 'requests' => $requests, 'all' => $all], 200);
        
        }
        else{
            return response()->json(['success' => false, 'message' => 'User Not Found'], 404);
        }
    }

    public function addInformationPosts($posts)
    {
        foreach ($posts as $post) {
            $post->type = 'post';
            $images = json_decode($post->images);
            $images = array_map(function ($item) {
                return url('/public/uploads/products/' . $item);
            }, $images);
            $vendor = $post->Vendor;
            $vendor->city = $vendor->city->city_name;
            $post->vendor = $vendor;
            $post->product_location = $post->Productcity->city_name;
            $post->vendor_location = $post->Vendorcity->city_name;
            $post->unit = $post->Unit->unit_name;
            $post->category = $post->Category->title;
            $post->subcategory = $post->SubCategory->title;
            $post->images = $images;
            $post->favStatus = $post->FavStatus();
            unset($post->unit_id);
            unset($post->category_id);
            unset($post->subcategory_id);
            unset($post->vendor_id);
        }
        return $posts;
    }

    public function addInformationRequests($prod_reqs)
    {
        foreach ($prod_reqs as $prod_req) {
            $prod_req->type = 'request';
            $prod_req->image = url('/public/uploads/products/' . $prod_req->image);
            $vendor = $prod_req->Vendor;
            $vendor->city = $vendor->city->city_name;
            $prod_req->vendor = $vendor;
            $prod_req->product_location = $prod_req->Productcity->city_name;
            $prod_req->vendor_location = $prod_req->Vendorcity->city_name;
            $prod_req->unit = $prod_req->Unit->unit_name;
            $prod_req->category = $prod_req->Category->title;
            $prod_req->subcategory = $prod_req->SubCategory->title;
            $prod_req->favStatus = $prod_req->FavStatus();
            unset($prod_req->unit_id);
            unset($prod_req->category_id);
            unset($prod_req->subcategory_id);
            unset($prod_req->vendor_id);
        }
        return $prod_reqs;
    }
}
