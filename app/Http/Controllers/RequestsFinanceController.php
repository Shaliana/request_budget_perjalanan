<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestsFinance;
use App\Models\Requests;
use App\Models\User;
use App\Models\Item;
use DataTables, Str, Alert;

class RequestsFinanceController extends Controller
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
        return view('request-finance.index');
    }

    public function finance_json($listFlag)
    {
        $where_query = '';
        switch ($listFlag) {
            case 'approve':
                $where_query = "status = 3";//sudah di transfer
                break;

            case 'new':
                $where_query = "status = 1";//hanya approved requests
                break;
        }

        $requests = Requests::with('item')
                    ->with('user')
                    ->whereRaw("$where_query")
                    ->get();
        
        return Datatables::of($requests)->make(true);
    }

    public function show($id)
    {
        $requests = Requests::with('user')->with('item')->with('finance')->findOrFail($id);

        return view('request-finance.show', [
            'requests' => $requests
        ]);
    }

    public function edit($id)
    {
        $requests = Requests::with('user')->with('item')->findOrFail($id);
        return view('request-finance.edit', [
            'requests' => $requests
        ]);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'bukti_transfer' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048'],
        ]);

        $input['requests_id'] = $id;
        if ($request->file('bukti_transfer')) {
            $bukti_transfer = Str::random(5).'_'.str_replace(' ', '_', $request->file('bukti_transfer')->getClientOriginalName());
            $input['bukti_transfer'] = 'images/bukti_transfer/'.$bukti_transfer;
            $request->file('bukti_transfer')->storeAs('images/bukti_transfer/', $bukti_transfer, 'public');
        }
        $input['information'] = $request->information;

        RequestsFinance::create($input);
        Requests::where('id', $id)->update(['status' => 3]);
        
        Alert::success('Success');
        return redirect()->route('requests_finance.index');
    }
}
