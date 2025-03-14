<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Portfolio;
use App\Models\Industry;
use App\Models\Technology;
use Carbon\Carbon;
use Artisan;
use Cache;

class AdminController extends Controller
{
    public function admin_dashboard(Request $request)
    {
        $filter = '';
        $categoryCounts = Category::withCount('portfolios')
                                    ->orderBy('name','ASC')
                                    ->get()
                                    ->map(function ($category) {
                                        return [
                                            'name' => $category->name,
                                            'portfolio_count' => $category->portfolios_count,
                                        ];
                                    });

        $industryCounts = Industry::withCount('portfolios')
                                    ->orderBy('name','ASC')
                                    ->get()
                                    ->map(function ($industry) {
                                        return [
                                            'name' => $industry->name,
                                            'portfolio_count' => $industry->portfolios_count,
                                        ];
                                    });
        
        $technologyCounts = Technology::withCount('portfolios')
                                    ->orderBy('name','ASC')
                                    ->get()
                                    ->map(function ($industry) {
                                        return [
                                            'name' => $industry->name,
                                            'portfolio_count' => $industry->portfolios_count,
                                        ];
                                    });

        return view('backend.dashboard', compact('filter','categoryCounts','industryCounts','technologyCounts'));
    }

    function getMonthlyPortfolioCount(Request $request){
        $year = $request->input('year', now()->year); // Default to current year

        $portfolios = Portfolio::selectRaw('MONTH(launch_date) as month, COUNT(*) as count')
                                ->whereYear('launch_date', $year)
                                ->groupBy('month')
                                ->orderBy('month')
                                ->get();

        $monthlyData = array_fill(1, 12, 0); // Fill all months with zero count
        foreach ($portfolios as $portfolio) {
            $monthlyData[$portfolio->month] = $portfolio->count;
        }
    
        return response()->json($monthlyData);
    }
    function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        flash(trans('messages.cache_cleared_successfully'))->success();
        return back();
    }
}
