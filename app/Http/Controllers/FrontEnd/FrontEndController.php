<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{

    public function index()
    {
        $q = \request()->input('q');
        $products = DB::table('products')->inRandomOrder()->paginate(\request()->get('per_page', 25));
        return view('pages.index', [

            'products' => $products,
            'q' => $q,
        ])->with('i', (\request()->input('page', 1) - 1) * 20);
    }


}
