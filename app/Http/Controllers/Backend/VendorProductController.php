<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\VendorProductDataTable;
use App\Traits\ImageUploadTrait;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTables)
    {
        return $dataTables->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required'],
            'image' => ['required', 'max:3000'],
            'category' => ['required'],
            'brand'=> ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required'],
            'long_description' => ['required'],
            'product_type' => ['nullable'],
            'seo_title' => ['nullable', 'max:250'],
            'seo_description' => ['nullable', 'max:400'],
            'status' => ['required'],
        ]);

        $product = new Product();
        $product->name = $request->name;
        $imagePath = $this->imageUpload($request, 'image', 'upload');
        $product->thumb_img = $imagePath;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->qty = $request->qty;
        $product->video_link = $request->video_link;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->product_type = $request->product_type;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->is_approved = 0;
        $product->status = $request->status;

        $product->save();

        toastr('Product Created Successfully', 'success');

        return redirect()->route('vendor.products.index');   

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function productSubCategories(Request $request){
       
        $subcategory = SubCategory::where('category_id', $request->id)->get();
        return $subcategory;

    }

    public function productChildCategories(Request $request){
        $childcategory = ChildCategory::where('sub_category_id', $request->id)->get();
        return $childcategory;

    }
}
