<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestsApproval;
use App\Models\Requests;
use App\Models\User;
use App\Models\Item;
use DataTables, Alert;

class RequestsApprovalController extends Controller
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
        return view('request-approval.index');
    }

    public function approval_json($listFlag)
    {
        $where_query = '';
        switch ($listFlag) {
            case 'approve':
                $where_query = "status = 1 or status = 3";
                break;

            case 'reject':
                $where_query = "status = 2";
                break;

            case 'new':
                $where_query = "status = 0";
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
        $requests = Requests::with('user')->with('item')->findOrFail($id);

        return view('request-approval.show', [
            'requests' => $requests
        ]);
    }

    public function approval_review($id)
    {
        $requests = Requests::with('user')->with('item')->findOrFail($id);

        return view('request-approval.review', [
            'requests' => $requests
        ]);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'status' => ['required'],
        ]);

        $input['requests_id'] = $id;
        $input['approved_by'] = auth()->user()->id;
        $input['information'] = $request->information;

        RequestsApproval::create($input);
        Requests::where('id', $id)->update(['status' => $request->status]);
        
        Alert::success('Success');
        return redirect()->route('requests_approval.index');
    }
}
