<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Comment;
use App\Model\Product;

use DB;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('public.master');
    }

    public function getCategories()
    {
        $categories = Category::where('cat_status', 1)->get();
        return response()->json($categories);
    }

    public function getBrands()
    {
        $brands = Brand::where('brand_status', 1)->get();
        return response()->json($brands);
    }

    public function getFeaturedProducts()
    {
        $featuredProduct = Product::where('status', 1)
            ->limit(3)
            ->get();

        //return $featuredProduct;
        return response()->json($featuredProduct);
    }

    public function getNewProducts()
    {
        $newProduct = Product::where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
        //return $featuredProduct;
        return response()->json($newProduct);
    }

    public function getCatProducts($id)
    {
        $catProduct = DB::table('products')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->where('categories.id', '=', $id)
        ->select('products.*', 'categories.cat_name', 'categories.cat_image')
        ->get();
        // dd($catProduct);
        //return $catProduct;
        return response()->json($catProduct);
    }

    public function  getAttributes(Request $request)
    {
        $id = $request->id;
        $attribues = DB::table('product_attributes')
        ->join('attributes','product_attributes.attribute_id', 'attributes.id')
        ->where('product_attributes.product_id','=', $id)->get()->first();
        // dd($attributes);
        if(isset($attribues->options) && trim($attribues->options) !=="")
        {
            $attribues->options = json_decode($attribues->options);
        }
        
        return response()->json($attribues);
    }
    public function getAllProductsByCat()
    {
         $Product = DB::table('products')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->select('products.*', 'categories.cat_name', 'categories.cat_image')
            ->orderBy('categories.id')
            ->get();
        return response()->json($Product);

    }
    public function getProductDetails($id)
    {
        $Product = DB::table('products')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->where('products.id', '=', $id)
            ->select('products.*', 'categories.cat_name')
            ->first();
            
        return response()->json($Product);
    }

    public function getProductSearch(Request $request)
    {
        $searchProduct = Product::where('product_name', 'LIKE', "%$request->searchKey%")->get();
        return response()->json([
            'searchData' => $searchProduct,
        ]);
    }

    public function getProductCheckbox(Request $request)
    {

        $product = Product::where('cat_id', $request->category)->get();

        return response()->json([
            'multiProduct' => $product,
        ]);
    }

    public function productComment(Request $request)
    {
        $comment = new Comment();
        $comment->commenter_id = $request->commenterId;
        $comment->commentable_id = $request->productId;
        $comment->comment = $request->commentText;
        $comment->save();

        return response()->json($comment);
    }

    public function getProductComment($productId)
    {
        //$comment = Comment::where('commentable_id', $productId)->get();
        $comment = DB::table('comments')
            ->join('customers', 'comments.commenter_id', '=', 'customers.id')
            ->where('comments.commentable_id', '=', $productId)
            ->select('comments.*', 'customers.first_name', 'customers.last_name')
            ->get();

        return response()->json($comment);
    }
}
