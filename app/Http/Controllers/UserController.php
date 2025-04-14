<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        $currentUser = auth()?->user();

        return view('librarian.users.index', compact('users', 'currentUser'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6', 
                'phone' => 'required', 
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'role' => DB::table('roles')->where('name', 'user')->first()->id,
            ]);

            return redirect()->back()->with('success', 'User created successfully.');
        } catch (\Throwable $e) {
            return redirect()->route('users.index')
                ->with('error_title', 'Error Creating User')
                ->with('error_message', $e->getMessage());
        }
    } 

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' =>'required',
                'email' =>'required|email|unique:users,email,'.$id,
                'password' =>'nullable|min:6',
                'phone' =>'required',
            ]);
            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'phone' => $request->phone,
            ]);
            return redirect()->back()->with('success', 'User updated successfully.');

        } catch (\Throwable $e) {
            return redirect()->route('users.index')
                ->with('error_title', 'Error Updating User')
                ->with('error_message', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }


}
