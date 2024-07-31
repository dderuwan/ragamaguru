<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime; 


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
        // Define the current date
        $currentDate = new \DateTime();
        
        // Define the start and end of the current month
        $currentMonthStart = (clone $currentDate)->modify('first day of this month')->format('Y-m-d');
        $currentMonthEnd = (clone $currentDate)->modify('last day of this month')->format('Y-m-d');
        
        // Define the start and end of the last month
        $lastMonthStart = (clone $currentDate)->modify('first day of last month')->format('Y-m-d');
        $lastMonthEnd = (clone $currentDate)->modify('last day of last month')->format('Y-m-d');
    
        // Log the last day of the current and last month
        \Log::info('Last Day of Current Month:', ['lastDayOfCurrentMonth' => $currentMonthEnd]);
        \Log::info('Last Day of Last Month:', ['lastDayOfLastMonth' => $lastMonthEnd]);
    
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
    
        // Prepare data for the chart
        $currentMonthDays = [];
        $lastMonthDays = [];
        $categories = [];
    
        // Get the number of days in the current month and last month
        $currentMonthDaysInMonth = (new \DateTime($currentMonthEnd))->format('j');
        $lastMonthDaysInMonth = (new \DateTime($lastMonthEnd))->format('j');
    
        // Collect data for current and last month
        for ($day = 0; $day < $currentMonthDaysInMonth; $day++) {
            $currentDateStr = (new \DateTime($currentMonthStart))->modify("+$day days")->format('Y-m-d');
            $lastDateStr = (new \DateTime($lastMonthStart))->modify("+$day days")->format('Y-m-d');
    
            // Add day to categories
            $categories[] = $day + 1;
    
            // Collect data for current month
            $currentMonthDays[] = isset($currentMonthRevenue[$currentDateStr]) ? $currentMonthRevenue[$currentDateStr]->total_revenue : 0;
    
            // Collect data for last month
            $lastMonthDays[] = isset($lastMonthRevenue[$lastDateStr]) ? $lastMonthRevenue[$lastDateStr]->total_revenue : 0;
        }
    
        // Ensure arrays have the same length
        $currentMonthDays = array_pad($currentMonthDays, $currentMonthDaysInMonth, 0);
        $lastMonthDays = array_pad($lastMonthDays, $currentMonthDaysInMonth, 0);
    
        // Calculate total revenue for the current and last months
        $totalCurrentMonthRevenue = array_sum($currentMonthDays);
        $totalLastMonthRevenue = array_sum($lastMonthDays);
    
        // Log total revenues
        \Log::info('Current Month Revenue Data:', ['currentMonthRevenue' => $currentMonthRevenue]);
        \Log::info('Last Month Revenue Data:', ['lastMonthRevenue' => $lastMonthRevenue]);
        \Log::info('Categories:', ['categories' => $categories]);
    
        // Return response
        return response()->json([
            'categories' => $categories,
            'currentMonth' => $currentMonthDays,
            'lastMonth' => $lastMonthDays,
            'totalCurrentMonthRevenue' => $totalCurrentMonthRevenue,
            'totalLastMonthRevenue' => $totalLastMonthRevenue
        ]);
    }
    
    


}




