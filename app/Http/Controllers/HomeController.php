<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LetterTypes;
use App\Models\Letters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        if (Auth::user()->role == 'guru'){
            return $this->guru();
        }else{
            return $this->staff();
        }
    }

    public function staff()
    {
        $staff  = User::where("role", "staff")->count();
        $guru = User::where("role", "guru")->count();
        $letters = Letters::count();
        $klasifikasi = LetterTypes::count();
        return view('dashboard.index-staff', compact('staff', 'guru', 'letters', 'klasifikasi'));
    }

    public function guru()
    {
        $letters = Letters::where('notulis', Auth::user()->id)->count(); 
        return view('dashboard.index-guru', compact('letters'));
    }
}
