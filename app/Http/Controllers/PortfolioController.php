<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Technology;
use Illuminate\Http\Request;

class PortfolioController extends Controller {

    public function index(Request $request) {

        $search = $request->has('search') ? $request->search : '';
        $status = $request->has('status') ? $request->status : '';

        $portfolios = Portfolio::with(['categories', 'industries', 'technologies']);

        if($search){
            $portfolios->where(function ($query) use ($search){
                $query->where('name', 'like','%' . $search . '%')
                    ->orWhere('site_url', 'like', '%' . $search . '%');
            });
        }

        if($status){
            if($status == 2){
                $status = 0;
            }
            $portfolios->where('status', $status);
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

        $portfolios = $portfolios->orderBy('sort_order','ASC')->paginate(15);

        $categories = Category::orderBy('name','ASC')->get();
        $industries = Industry::orderBy('name','ASC')->get();
        $technologies = Technology::orderBy('name','ASC')->get();

        return view('backend.portfolios.index', compact('portfolios','search','status','categories','industries','technologies'));
    }

    public function create() {
        $categories = Category::where('status',1)->orderBy('name','ASC')->get();
        $industries = Industry::where('status',1)->orderBy('name','ASC')->get();
        $technologies = Technology::where('status',1)->orderBy('name','ASC')->get();
        return view('backend.portfolios.create', compact('categories', 'industries', 'technologies'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'site_url' => 'required|url|unique:portfolios,site_url',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
            'categories' => 'required|array',
            'industries' => 'required|array',
            'technologies' => 'required|array',
        ]);

        $portfolio = Portfolio::create($request->only(['name', 'description', 'site_url', 'sort_order', 'status']));
        $portfolio->categories()->attach($request->categories);
        $portfolio->industries()->attach($request->industries);
        $portfolio->technologies()->attach($request->technologies);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio created successfully!');
    }

    
    public function edit($portfolio)
    {
        $portfolio = Portfolio::find(decrypt($portfolio));
        return view('backend.portfolios.create', [
            'portfolio' => $portfolio,
            'categories' => Category::where('status',1)->orderBy('name','ASC')->get(),
            'industries' => Industry::where('status',1)->orderBy('name','ASC')->get(),
            'technologies' => Technology::where('status',1)->orderBy('name','ASC')->get(),
        ]);
    }

    public function update(Request $request, $portfolio)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'site_url' => 'required|url|unique:portfolios,site_url,' . $portfolio,
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
            'categories' => 'required|array',
            'industries' => 'required|array',
            'technologies' => 'required|array',
        ]);

        $portfolio = Portfolio::find($portfolio);
        $portfolio->update($request->only(['name', 'description', 'site_url', 'sort_order', 'status']));
        $portfolio->categories()->sync($request->categories);
        $portfolio->industries()->sync($request->industries);
        $portfolio->technologies()->sync($request->technologies);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio Updated Successfully');
    }

    public function updateStatus(Request $request)
    {
        $portfolio = Portfolio::findOrFail($request->id);
        $portfolio->status = $request->status;
        $portfolio->save();
     
        return 1;
    }

    public function destroy($id)
    {
        Portfolio::destroy($id);

        flash('Portfolio '.trans('messages.deleted_msg'))->success();
        return redirect()->route('portfolios.index');
    }

}
