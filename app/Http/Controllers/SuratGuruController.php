<?php

namespace App\Http\Controllers;

use App\Exports\DataSuratGuruFromView;
use App\Models\Letters;
use App\Models\Results;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class SuratGuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search_input');

        $page = $request->input('page');
        $perPage = 2;

        $letters = DB::table('letters')
            ->join('letter_types', 'letter_types.id', '=', 'letters.letter_type_id')
            ->join('users', 'users.id', '=', 'letters.notulis')
            ->leftJoin('results', 'results.letter_id', '=', 'letters.id')
            ->select(['letters.*', 'letter_types.letter_code', 'users.name AS user_name', 'results.id AS result'])
            ->where('letters.notulis', Auth::user()->id)
            ->where(function ($query) use ($search) {
                $query->where('letter_types.letter_code', 'LIKE', "%$search%");
                $query->orwhere('letters.letter_perihal', 'LIKE', "%$search%");
                $query->orWhere('users.name', 'LIKE', "%$search%");
                $query->orWhere('letters.recipients', 'LIKE', "%$search%");
            })
            ->paginate($perPage);

        $perPage = (is_null($page) || $page == 1) ? 0 : $perPage;


        return view('data-surat-guru.index', compact('letters', 'perPage'));
    }

    public function create($id)
    {
        $letter = Letters::where('id', $id)->first();  

        return view('data-surat-guru.create', compact('letter'));
    }

    public function detail($id)
    {
        $data = Letters::where('id', $id)->first();
        return view('data-surat-guru.detail', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_surat' => 'required',
            'isi_surat' => 'required',
            'peserta' => 'required',
        ]);

            Results::create([
            'letter_id' => $request->id_surat,
            'notes' => $request->isi_surat,
            'presence_recipients' => json_encode($request -> peserta),
        ]);

        return redirect()->route('data-surat-guru.index');
    }

    public function downloadExcel()
    {
        $letters = 'Data Surat Guru.xlsx';
        return Excel::download(new DataSuratGuruFromView, $letters);
    }
}
