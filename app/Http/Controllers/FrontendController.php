<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Technology;
use Illuminate\Http\Request;
use Artisan;
use Cache;

class FrontendController extends Controller {

    public function login(){
        return view('login');
    }

    public function index(Request $request) {

        if (!session()->has('verified_email')) {
            abort(404);
        }

        $search = $request->has('search') ? $request->search : '';
        $portfolios = $categoryPortfolios = [];
        
        if (($request->has('search') ||$request->has('category') || $request->has('industry') || $request->has('technology')) && ($request->search != '' || $request->category!= '' || $request->industry != '' || $request->technology != '')) {
            $portfolios = Portfolio::with(['categories', 'industries', 'technologies']);

            if($search){
                $portfolios->where(function ($query) use ($search){
                    $query->where('name', 'like','%' . $search . '%')
                        ->orWhere('site_url', 'like', '%' . $search . '%');
                });
            }
    
            if ($request->has('category') && !empty($request->category)) {
                $portfolios->whereHas('categories', function ($q) use ($request) {
                    $q->where('category_id', $request->category);
                });
            }
        
            if ($request->has('industry') && !empty($request->industry)) {
                $portfolios->whereHas('industries', function ($q) use ($request) {
                    $q->where('industry_id', $request->industry);
                });
            }
        
            if ($request->has('technology') && !empty($request->technology)) {
                $portfolios->whereHas('technologies', function ($q) use ($request) {
                    $q->where('technology_id', $request->technology);
                });
            }
    
            $portfolios = $portfolios->where('status', 1)->orderBy('sort_order','ASC')->get();
        }else{
            $categoryPortfolios = Category::with(['portfolios' => function ($query) {
                                        $query->where('status', 1)->orderBy('sort_order', 'ASC'); // Sorting portfolios within each category
                                    }])->where('status', 1)->get();
        }
        
      
        $categories = Category::where('status', 1)->orderBy('name','ASC')->get();
        $industries = Industry::where('status', 1)->orderBy('name','ASC')->get();
        $technologies = Technology::where('status', 1)->orderBy('name','ASC')->get();

        return view('home', compact('categoryPortfolios','portfolios','search','categories','industries','technologies'));
    }

    function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        flash(trans('messages.cache_cleared_successfully'))->success();
        return back();
    }
}
