<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('name');
        $page = $request->input('page');
        $perPage = 5;

        $guru = User::where("role", "guru")
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE' , "%$search%");
                $query->orWhere('email', 'LIKE' , "%$search%");
            })
            ->paginate($perPage);

            $perPage = (is_null($page) || $page == 1) ? 0 : $perPage;

        return view('data-guru.index', compact('guru', 'perPage'));
    }

    public function create()
    {
        return view('data-guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => "guru",
            'password' => Hash::make(substr($request->name, 0, 3) . substr($request->email, 0, 3)),
        ]);

        return redirect()->route('data-guru.index')->with('success', 'Berhasil menambahkan data Guru!');
    }

    public function edit($id)
    {
        $guru = User::find($id);
        return view('data-guru.edit', compact('guru'));
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

        return redirect()->route('data-guru.index')->with('success', 'Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data Guru');
    }

    public function search(Request $request)
    {
        $search = $request->input('name');
        $guru = User::where('name','like',"%$search%")->get();
        return view('data-guru.index', compact('guru'));
    } 
    
}
