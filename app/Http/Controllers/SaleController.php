<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')
        ->where('user_id', '=', Auth::id())
        ->where('product_stock', '>', 0)
        ->get();
        
        return view('sales.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        
        $product = DB::table('products')->select('product_stock', 'product_price')->where('id', '=', $id)->first();
        

        $rules = [
            'product_stock' => 'required|numeric|between:0,'.$product->product_stock,
        ];

        $this->validate($request, $rules);


        $stock = DB::table('products')->where('id', '=', $id)->update([
            'product_stock' => $product->product_stock - $request->input('product_stock'),
        ]);

        if($stock != false){
            $sale = DB::table('orders')->insert([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'qyt' => $request->input('product_stock'),
                'unit_price' => $product->product_price,
            ]);
        }else{
            $sale = false;
        }

        if($sale != false){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product successfully sold!.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product failed to sale.']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
