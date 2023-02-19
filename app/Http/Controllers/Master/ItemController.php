<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use DataTables, Alert;

class ItemController extends Controller
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
        $items = Item::all();

        if ($request->ajax()) {
            return DataTables::of($items)->make(true);
        }

        return view('master.item.index');
    }

    public function show($id)
    {
        $items = Item::findOrFail($id);

        return view('master.item.show', [
            'items' => $items
        ]);
    }

    public function create()
    {
        return view('master.item.create');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $input = $request->all();
        Item::create($input);

        Alert::success('Success', 'Item created successfully');
        return redirect()->route('items.index');
    }

    public function edit($id)
    {
        $items = Item::findOrFail($id);

        return view('master.item.edit', [
            'items' => $items
        ]);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $input = $request->all();
        $data = Item::findOrFail($id);
        $data->update($input);

        Alert::success('Success', 'Item updated successfully');
        return redirect()->route('items.index');
    }

    public function destroy($id)
    {
        $data = Item::findOrFail($id);
        $data->delete();

        Alert::success('Success', 'Item deleted successfully');
        return redirect()->route('items.index');
    }
}
