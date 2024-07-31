<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RevenueController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function getMonthlyRevenue()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $monthlyRevenue = DB::table('pos')
            ->select(DB::raw('YEAR(date) as year, MONTH(date) as month, SUM(total_cost_payment) as monthly_revenue'))
            ->whereBetween('date', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy(DB::raw('YEAR(date), MONTH(date)'))
            ->orderBy(DB::raw('YEAR(date), MONTH(date)'))
            ->get();

        // Ensure all months are represented
        $revenueData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthKey = $month->format('Y-n');
            $revenueData[$monthKey] = 0;
        }

        foreach ($monthlyRevenue as $revenue) {
            $monthKey = $revenue->year . '-' . $revenue->month;
            $revenueData[$monthKey] = $revenue->monthly_revenue;
        }

        $response = [];
        foreach ($revenueData as $key => $value) {
            list($year, $month) = explode('-', $key);
            $response[] = [
                'year' => $year,
                'month' => $month,
                'monthly_revenue' => $value
            ];
        }

        return response()->json($response);
    }


    
    public function getDailyRevenueForColumnChart()
    {
        $currentDate = Carbon::now();
        
        // Define the start and end of the current month
        $currentMonthStart = $currentDate->startOfMonth();
        $currentMonthEnd = $currentDate->endOfMonth();

        // Define the start and end of the last month
        $lastMonthStart = $currentDate->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $currentDate->copy()->subMonth()->endOfMonth();

        // Retrieve revenue data for the current month
        $currentMonthRevenue = DB::table('pos')
            ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(total_cost_payment) as total_revenue'))
            ->whereBetween('date', [$currentMonthStart, $currentMonthEnd])
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy('date', 'ASC')
            ->get()
            ->keyBy('date');

        // Retrieve revenue data for the last month
        $lastMonthRevenue = DB::table('pos')
            ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(total_cost_payment) as total_revenue'))
            ->whereBetween('date', [$lastMonthStart, $lastMonthEnd])
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy('date', 'ASC')
            ->get()
            ->keyBy('date');

        // Calculate total revenue for the current and last months
        $totalCurrentMonthRevenue = $currentMonthRevenue->sum('total_revenue');
        $totalLastMonthRevenue = $lastMonthRevenue->sum('total_revenue');

        // Prepare data for the chart
        $currentMonthDays = [];
        $lastMonthDays = [];
        $categories = [];

        $currentMonthDaysInMonth = $currentMonthEnd->day;
        $lastMonthDaysInMonth = $lastMonthEnd->day;

        for ($day = 1; $day <= max($currentMonthDaysInMonth, $lastMonthDaysInMonth); $day++) {
            $currentDate = $currentMonthStart->copy()->day($day)->format('Y-m-d');
            $lastDate = $lastMonthStart->copy()->day($day)->format('Y-m-d');

            // Populate current month's revenue
            if ($day <= $currentMonthDaysInMonth) {
                $categories[] = $day;
                $currentMonthDays[] = isset($currentMonthRevenue[$currentDate]) ? $currentMonthRevenue[$currentDate]->total_revenue : 0;
            }

            // Populate last month's revenue
            if ($day <= $lastMonthDaysInMonth) {
                $lastMonthDays[] = isset($lastMonthRevenue[$lastDate]) ? $lastMonthRevenue[$lastDate]->total_revenue : 0;
            }
        }

        // Ensure arrays have the same length
        $currentMonthDays = array_pad($currentMonthDays, $currentMonthDaysInMonth, 0);
        $lastMonthDays = array_pad($lastMonthDays, $lastMonthDaysInMonth, 0);
        
        \Log::info('Current Month Revenue Data:', ['currentMonthRevenue' => $currentMonthRevenue]);
\Log::info('Last Month Revenue Data:', ['lastMonthRevenue' => $lastMonthRevenue]);
\Log::info('Categories:', ['categories' => $categories]);


        return response()->json([
            'categories' => $categories,
            'currentMonth' => $currentMonthDays,
            'lastMonth' => $lastMonthDays,
            'totalCurrentMonthRevenue' => $totalCurrentMonthRevenue,
            'totalLastMonthRevenue' => $totalLastMonthRevenue
        ]);
    }
}




