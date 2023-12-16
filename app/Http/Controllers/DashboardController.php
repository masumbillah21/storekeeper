<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {

        $today = DB::table('orders')
            ->whereDate('created_at', '=', now())
            ->sum(DB::raw('unit_price * qyt'));
        
        $yesterday = DB::table('orders')
            ->whereBetween('created_at', [now()->subDay()->startOfDay(), now()->subDay()->endOfDay()])
            ->sum(DB::raw('unit_price * qyt'));
        
        $thisMonth = DB::table('orders')
            ->whereMonth('created_at', '=', now()->month)
            ->whereYear('created_at', '=', now()->year)
            ->sum(DB::raw('unit_price * qyt'));
       
        $lastMonth = DB::table('orders')
            ->whereMonth('created_at', '=', now()->month - 1)
            ->whereYear('created_at', '=', now()->year)
            ->sum(DB::raw('unit_price * qyt'));
        
        return view('dashboard', compact('today', 'yesterday', 'thisMonth', 'lastMonth'));
    }
}
