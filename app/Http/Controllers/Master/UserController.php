<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Bank;
use DataTables, Alert;

class UserController extends Controller
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
        $users = User::with('role')->get();

        if ($request->ajax()) {
            return DataTables::of($users)->make(true);
        }

        return view('master.user.index');
    }

    public function show($id)
    {
        $users = User::with('role')->with('bank')->findOrFail($id);

        return view('master.user.show', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::pluck('id', 'role_name');
        $banks = Bank::pluck('id', 'name');

        return view('master.user.create', [
            'roles' => $roles,
            'banks' => $banks,
        ]);
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required'],
            'account_number' => ['numeric'],
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        User::create($input);

        Alert::success('Success', 'User created successfully');
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        $roles = Role::pluck('id', 'role_name');
        $banks = Bank::pluck('id', 'name');

        return view('master.user.edit', [
            'users' => $users,
            'roles' => $roles,
            'banks' => $banks,
        ]);
    }

    public function update(Request $request, $id)
    {   
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', (isset($id) ? 'unique:users,email,'.$id : 'unique:users,email,NULL,id')],
            'role_id' => ['required'],
            'account_number' => ['numeric'],
        ]);

        $input = $request->all();
        $data = User::findOrFail($id);
        $data->update($input);

        Alert::success('Success', 'User updated successfully');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        Alert::success('Success', 'User deleted successfully');
        return redirect()->route('users.index');
    }
}
