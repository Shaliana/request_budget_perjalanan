<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\Item;
use DataTables, Alert;

class RequestsController extends Controller
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
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $requests = Requests::with('item')->where('user_id', $user_id)->get();

        if ($request->ajax()) {
            return DataTables::of($requests)->make(true);
        }

        return view('request.index', [
            'requests' => $requests
        ]);
    }

    public function show($id)
    {
        $requests = Requests::with('item')->findOrFail($id);

        return view('request.show', [
            'requests' => $requests
        ]);
    }

    public function create()
    {
        $items = Item::pluck('id', 'name');

        return view('request.create', [
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'item_id' => ['required'],
            'nominal' => ['required'],
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $input['nominal'] = round(str_replace(",", ".", str_replace(".", "", $request->nominal)), 2);
        Requests::create($input);

        Alert::success('Success', 'Request created successfully.');
        return redirect()->route('requests.index');
    }
}
