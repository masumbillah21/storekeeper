<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        $today = DB::table('orders')
            ->where('user_id', '=', Auth::id())
            ->whereDate('created_at', '=', now())
            ->sum(DB::raw('unit_price * qyt'));
        
        $yesterday = DB::table('orders')
            ->where('user_id', '=', Auth::id())
            ->whereDay('created_at', '=', now()->day - 1)
            ->whereYear('created_at', '=', now()->year)
            ->sum(DB::raw('unit_price * qyt'));
        
        $thisMonth = DB::table('orders')
            ->where('user_id', '=', Auth::id())
            ->whereMonth('created_at', '=', now()->month)
            ->whereYear('created_at', '=', now()->year)
            ->sum(DB::raw('unit_price * qyt'));
       
        $lastMonth = DB::table('orders')
            ->where('user_id', '=', Auth::id())
            ->whereMonth('created_at', '=', now()->month - 1)
            ->whereYear('created_at', '=', now()->year)
            ->sum(DB::raw('unit_price * qyt'));
        
        return view('dashboard', compact('today', 'yesterday', 'thisMonth', 'lastMonth'));
    }
}
