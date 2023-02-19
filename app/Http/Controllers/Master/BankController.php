<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use DataTables, Alert;

class BankController extends Controller
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
        $banks = Bank::all();

        if ($request->ajax()) {
            return DataTables::of($banks)->make(true);
        }

        return view('master.bank.index');
    }

    public function show($id)
    {
        $banks = Bank::findOrFail($id);

        return view('master.bank.show', [
            'banks' => $banks
        ]);
    }

    public function create()
    {
        return view('master.bank.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $input = $request->all();
        Bank::create($input);

        Alert::success('Success', 'Bank created successfully');
        return redirect()->route('bank.index');
    }

    public function edit($id)
    {
        $banks = Bank::findOrFail($id);

        return view('master.bank.edit', [
            'banks' => $banks
        ]);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $input = $request->all();
        $data = Bank::findOrFail($id);
        $data->update($input);

        Alert::success('Success', 'Bank updated successfully');
        return redirect()->route('bank.index');
    }

    public function destroy($id)
    {
        $data = Bank::findOrFail($id);
        $data->delete();

        Alert::success('Success', 'Bank deleted successfully');
        return redirect()->route('bank.index');
    }
}
