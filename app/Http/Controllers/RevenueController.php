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



    public function getGroupedRevenueForThisAndLastMonth()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        // Get revenue for this month and last month
        $currentMonthRevenue = $this->getGroupedRevenue($currentYear, $currentMonth);
        $lastMonthRevenue = $this->getGroupedRevenue($currentYear, $lastMonth);

        // Total revenue for this month and last month
        $totalCurrentMonthRevenue = array_sum($currentMonthRevenue['revenue']);
        $totalLastMonthRevenue = array_sum($lastMonthRevenue['revenue']);

        $response = [
            'dates' => $currentMonthRevenue['dates'],
            'thisMonth' => $currentMonthRevenue['revenue'],
            'lastMonth' => $lastMonthRevenue['revenue'],
            'totalCurrentMonthRevenue' => $totalCurrentMonthRevenue,
            'totalLastMonthRevenue' => $totalLastMonthRevenue
        ];

        return response()->json($response);
    }


    private function getGroupedRevenue($year, $month)
    {
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();
    
        $revenues = DB::table('pos')
            ->select(DB::raw('DATE(date) as date, SUM(total_cost_payment) as revenue'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy(DB::raw('DATE(date)'))
            ->get();
    
        // Prepare data
        $dates = [];
        $revenuesGrouped = [];
        $start = $startDate->copy();
        $groupSize = 5; // Number of days per group
    
        while ($start->lte($endDate)) {
            // Set the end date of the current group
            $end = $start->copy()->addDays($groupSize - 1);
    
            if ($end->gt($endDate)) {
                $end = $endDate;
            }
    
            $dates[] = $start->format('d M') . ' - ' . $end->format('d M');
    
            $totalRevenue = 0;
            foreach ($revenues as $revenue) {
                if (Carbon::parse($revenue->date)->between($start, $end)) {
                    $totalRevenue += $revenue->revenue;
                }
            }
            $revenuesGrouped[] = $totalRevenue;
    
            // Move to the next group
            $start->addDays($groupSize);
    
            if ($start->gt($endDate)) {
                break;
            }
        }
    
        return [
            'dates' => $dates,
            'revenue' => $revenuesGrouped
        ];
    }
    


}
