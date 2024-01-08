<?php

namespace App\Http\Controllers;

use App\Models\LetterTypes;
use App\Exports\KlasifikasiSuratExport;
use App\Exports\KlasifikasiSuratFromView;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Letters;
use Maatwebsite\Excel\Facades\Excel;

class KlasifikasiSuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('name_type');
        $page = $request->input('page');
        $perPage = 5;

        $klasifikasi = LetterTypes::where('name_type','like',"%$search%")
            ->orWhere('letter_code','like',"%$search%")
            ->paginate($perPage);

            $perPage = (is_null($page) || $page == 1) ? 0 : $perPage;


        return view('data-klasifikasi-surat.index', compact('klasifikasi', 'perPage'));
    }

    public function create()
    {
        return view('data-klasifikasi-surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_surat' => 'required|min:5',
            'klasifikasi_surat' => 'required',
        ]);

        $code = LetterTypes::count();

        LetterTypes::create([
            'letter_code' => $request->kode_surat. '-'. $code,
            'name_type' => $request->klasifikasi_surat,
        ]);

        return redirect()->route('klasifikasi-surat.index')->with('success', 'Berhasil menambah data klasifikasi Surat!');

    }

    public function edit($id)
    {
        $klasifikasi = LetterTypes::find($id);
        return view('data-klasifikasi-surat.edit', compact('klasifikasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_surat' => 'required|min:5',
            'klasifikasi_surat' => 'required'
        ]);       

        $latterData = [
            'letter_code' => $request->kode_surat,
            'name_type' => $request->klasifikasi_surat,
        ];

        LetterTypes::where('id', $id)->update($latterData);
        return redirect()->route('klasifikasi-surat.index')->with('success', 'Berhasil mengubah!');
    }

    public function detail($id)
    {
        $letters = Letters::where('letter_type_id', $id)->get();
        return view('data-klasifikasi-surat.detail', compact('letters'));
    }

    public function download($id)
    {
        $data = Letters::where('id', $id)->first();

        $pdf = PDF::loadView('data-klasifikasi-surat.download', compact('data'));

        return $pdf->download( $data->letterTypes->letter_code. " " .$data->letter_perihal . ".pdf" );
    }
    
    public function destroy($id)
    {
        LetterTypes::where('id', $id)->delete();
        return redirect()->route('klasifikasi-surat.index')->with('success', 'Berhasil menghapus data!');
    }

    public function downloadExcel()
    {
        $klasifikasi = 'Data Klasifikasi Surat.xlsx';

        // return Excel::download(new KlasifikasiSuratExport, $klasifikasi);

        return Excel::download(new KlasifikasiSuratFromView, $klasifikasi);
    }
}
