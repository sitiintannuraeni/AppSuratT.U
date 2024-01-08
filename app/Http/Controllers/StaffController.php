<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('name');
        $page = $request->input('page');
        $perPage = 5;
        
        $staff  = User::where("role", "staff")
            ->where('id', '!=', Auth::user()->id)
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE' , "%$search%");
                $query->orWhere('email', 'LIKE' , "%$search%");
            })
            ->paginate($perPage);

        $perPage = (is_null($page) || $page == 1) ? 0 : $perPage;

        return view('data-staff-tata-usaha.index', compact('staff', 'perPage'));
    }

    public function create()
    {
        return view('data-staff-tata-usaha.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => "staff",
            'password' => Hash::make(substr($request->name, 0, 3) . substr($request->email, 0, 3)),
        ]);

        return redirect()->route('staff-tata-usaha.index')->with('success', 'Berhasil menambahkan data Staf!');
    }

    public function edit($id)
    {
        $staff = User::find($id);
        return view('data-staff-tata-usaha.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:5',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->password !==null) {
            $userData['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($userData);

        return redirect()->route('staff-tata-usaha.index')->with('success', 'Berhasil mengubah data Staff!');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('staff-tata-usaha.index')->with('success', 'Berhasil menghapus data Staff!');
    }
}
