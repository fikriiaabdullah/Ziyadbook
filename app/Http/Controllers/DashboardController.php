<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Set default date range to current month if not specified
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Parse dates
        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();

        // Filter by date range
        $productCount = Product::whereBetween('created_at', [$startDateTime, $endDateTime])->count();
        $orders = Order::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
        $orderCount = $orders->count();
        $revenue = $orders->sum('total_price');

        // Get recent activities
        $recentActivities = Activity::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->latest()
            ->take(10)
            ->get();

        // Chart data for orders by date
        $ordersByDate = Order::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format for chart
        $chartLabels = $ordersByDate->pluck('date')->toJson();
        $chartOrders = $ordersByDate->pluck('count')->toJson();
        $chartRevenue = $ordersByDate->pluck('revenue')->toJson();

        // Products added by date for chart
        $productsAddedByDate = Product::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $productChartLabels = $productsAddedByDate->pluck('date')->toJson();
        $productChartData = $productsAddedByDate->pluck('count')->toJson();

        return view('dashboard', compact(
            'productCount',
            'orderCount',
            'revenue',
            'recentActivities',
            'startDate',
            'endDate',
            'chartLabels',
            'chartOrders',
            'chartRevenue',
            'productChartLabels',
            'productChartData'
        ));
    }
}
