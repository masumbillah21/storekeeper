<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')
        ->where('user_id', '=', Auth::id())
        ->where('is_trash', '=', 0)
        ->orderByDesc('created_at')
        ->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string|max:255',
            'product_price' => 'required|numeric|between:0,9999999.99',
            'product_stock' => 'required|numeric|between:1,9999999',
            'product_image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
        ];

        $this->validate($request, $rules);

        $image = $request->file('product_image');
        $name = now()->timestamp . '.'. $image->getClientOriginalExtension();
        $image->move(public_path('images'), $name);

        $product = DB::table('products')->insert([
            'user_id' => Auth::id(),
            'product_name' => $request->input('product_name'),
            'product_desc' => $request->input('product_desc'),
            'product_price' => $request->input('product_price'),
            'product_stock' => $request->input('product_stock'),
            'product_image' => 'images/'.$name,
        ]);

        if($product != false){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product created Successfully!.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product Failed to create.']);
        }
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
        $product = DB::table('products')
        ->where('user_id', '=', Auth::id())
        ->where('is_trash', '=', 0)
        ->where('id', '=', $id)->first();

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string|max:255',
            'product_price' => 'required|numeric|between:0,9999999.99',
            'product_stock' => 'required|numeric|between:0,9999999',
        ];
        if(empty($request->input('product_old_image'))){
            $rules['product_image'] = 'required|mimes:png,jpg,jpeg,webp|max:2048';
        }
        $this->validate($request, $rules);

        $data = [
            'product_name' => $request->input('product_name'),
            'product_desc' => $request->input('product_desc'),
            'product_price' => $request->input('product_price'),
            'product_stock' => $request->input('product_stock'),
        ];
        
        $image = $request->file('product_image');
        $old_image = $request->input('product_old_image');
        if(!empty($image)){
            if(file_exists($old_image)){
                unlink($old_image);
            }
            $name = now()->timestamp . '.'. $image->getClientOriginalExtension();
            $image->move(public_path('images'), $name);
            $data['product_image'] = 'images/' . $name;
        }

        

        $product = DB::table('products')
        ->where('user_id', '=', Auth::id())
        ->where('is_trash', '=', 0)
        ->where('id', '=', $id)->update($data);

        if($product != false){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product successfully updated!.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product Failed to update.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $customMessages = [
            'password_'.$id.'.required' => 'The password is required.',
        ];

        $rules = [
            'password_'.$id => ['required', 'current_password'],
        ];
        $this->validate($request, $rules, $customMessages);

        $product = DB::table('products')
        ->where('user_id', '=', Auth::id())
        ->where('id', '=', $id)
        ->update(['is_trash' => 1]);

        if($product != false){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product successfully deleted!.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product failed to delete.']);
        }
    }
}
