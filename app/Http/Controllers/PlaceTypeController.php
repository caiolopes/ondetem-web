<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class PlaceTypeController extends Controller
{
    public function categories(Request $request)
    {
        return DB::table('place_types')->select('category')->distinct()->get();
    }

    public function types(Request $request)
    {
        $category = $request->input('category');

        if ($category != null)
            return DB::table('place_types')->select('id')->addSelect('type')->where('category', $category)->distinct()->get();
        else
            return 'Missing Category';
    }
}
