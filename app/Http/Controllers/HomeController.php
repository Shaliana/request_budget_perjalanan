<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $years = Requests::select(
            DB::raw("YEAR(created_at) as year")
        )
        ->groupby('year')
        ->get();
        // dd($this->requests_item());
        
        return view('home', [
            'years' => $years
        ]);
    }

    public function requests_month(Request $request)
    {
        $request_month = Requests::select(
            DB::raw("MONTHNAME(created_at) as month"), 
            DB::raw("count(*) as total")
        )
        ->whereRaw('YEAR(created_at) = '.$request->year)
        ->groupby('month')
        ->orderby(DB::raw('MONTH(created_at)'))
        ->pluck('total', 'month');
        // dd($request_month);
        return array(
            'label' => $request_month->keys(),
            'value' => $request_month->values(),
        );
    }

    public function requests_item()
    {
        $request_item = Requests::select(
            'item_id',
            DB::raw("count(*) as total")
        )
        ->with('item')
        ->groupby('item_id')
        ->get()
        ->pluck('total', 'item.name');
        // dd($request_item);
        return array(
            'label' => $request_item->keys(),
            'value' => $request_item->values(),
        );
    }
}
