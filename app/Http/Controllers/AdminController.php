<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Search;
use Artisan;
use Cache;

class AdminController extends Controller
{
    public function admin_dashboard(Request $request)
    {
        $filter = '';
        return view('backend.dashboard', compact('filter'));
    }

    function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        flash(trans('messages.cache_cleared_successfully'))->success();
        return back();
    }
}
