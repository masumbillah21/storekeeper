<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = DB::table('orders')
        ->join('products', 'orders.product_id', '=', 'products.id')
        ->select('product_image','product_name', 'product_desc', 'qyt', 'unit_price', 'orders.created_at as created_at')
        ->where('orders.user_id', '=', Auth::id())
        ->orderByDesc('orders.created_at')
        ->get();

        $id = 'all';

        return view('orders.index', compact('orders', 'id'));
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
        if($id === 'yesterday'){
            $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('product_image','product_name', 'product_desc', 'qyt', 'unit_price', 'orders.created_at as created_at')
            ->where('orders.user_id', '=', Auth::id())
            ->whereDay('orders.created_at', '=', now()->day - 1)
            ->whereMonth('orders.created_at', '=', now()->month)
            ->whereYear('orders.created_at', '=', now()->year)
            ->orderByDesc('orders.created_at')
            ->get();
        }else if($id === 'this-month'){
            $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('product_image','product_name', 'product_desc', 'qyt', 'unit_price', 'orders.created_at as created_at')
            ->where('orders.user_id', '=', Auth::id())
            ->whereMonth('orders.created_at', '=', now()->month)
            ->whereYear('orders.created_at', '=', now()->year)
            ->orderByDesc('orders.created_at')
            ->get();
        }else if($id === 'last-month'){
            $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('product_image','product_name', 'product_desc', 'qyt', 'unit_price', 'orders.created_at as created_at')
            ->where('orders.user_id', '=', Auth::id())
            ->whereMonth('orders.created_at', '=', now()->month - 1)
            ->whereYear('orders.created_at', '=', now()->year)
            ->orderByDesc('orders.created_at')
            ->get();
        }else{
            $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('product_image','product_name', 'product_desc', 'qyt', 'unit_price', 'orders.created_at as created_at')
            ->where('orders.user_id', '=', Auth::id())
            ->whereDate('orders.created_at', '=', now())
            ->orderByDesc('orders.created_at')
            ->get();
        }
        

        return view('orders.index', compact('orders', 'id'));
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
}
