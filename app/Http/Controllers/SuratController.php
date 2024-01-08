<?php

namespace App\Http\Controllers;

use App\Models\LetterTypes;
use App\Exports\DataSuratFromView;
use App\Models\User;
use App\Models\Letters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search_input');
        $page = $request->input('page');
        $perPage = 5;

        $letters = DB::table('letters')
            ->join('letter_types', 'letter_types.id', '=', 'letters.letter_type_id')
            ->join('users', 'users.id', '=', 'letters.notulis')
            ->leftJoin('results', 'results.letter_id', '=', 'letters.id')
            ->select(['letters.*', 'letter_types.letter_code', 'users.name AS user_name', 'results.id AS result'])
            ->where('letter_types.letter_code', 'LIKE', "%$search%")
            ->where(function ($query) use ($search) {
                $query->orWhere('letters.letter_perihal', 'LIKE', "%$search%");
                $query->orWhere('users.name', 'LIKE', "%$search%");
                $query->orWhere('letters.recipients', 'LIKE', "%$search%");
            })
            ->paginate($perPage);

        $perPage = (is_null($page) || $page == 1) ? 0 : $perPage;

        return view('data-surat.index', compact('letters', 'perPage'));
    }

    public function create()
    {
        // ambil data letter_types untuk option select klaifikasi surat
        $letterTypes = LetterTypes::get();

        // ambil data user dengan rol guru untuk select notulis dan peserta
        $users = User::where('role', 'guru')->get();       

        return view('data-surat.create', compact('letterTypes', 'users' ));
    }

    public function preview($id)
    {
        $data = Letters::where('id', $id)->first();

        return view('data-surat.preview', compact('data'));
    }

    public function print($id)
    {
        $data = Letters::find($id);
        $fileName = $data->letterTypes->letter_code. " " .$data->letter_perihal . ".pdf";

        $dompdf = new Dompdf();

        $html = View::make('pdf-surat.index', compact('data', 'fileName'))->render();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4');

        $dompdf->render();

        // $dompdf->stream('testing.pdf', array('Attachment' => false));
        // exit(0);

        $pdfContent = $dompdf->output();
        return Response::make($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"',
        ]);
    }

    public function detail($id)
    {
        $data = Letters::where('id', $id)->first();
        return view('data-surat.detail', compact('data'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'klasifikasi_surat' => 'required',
            'perihal' => 'required',
            'peserta' => 'required|array',
            'isi_surat' => 'required',
            'notulis' => 'required',
        ]);

        $attachment = null;

        if($request->hasFile('lampiran')) {
            $extension = $request->file('lampiran')->extension();
            $fileName = date('dmyHis'). "." . $extension;
            $this->validate($request, ['lampiran' => 'required|file|max:5000']);
            $path = Storage::putFileAs('public/lampiran', $request->file('lampiran'), $fileName);
            $attachment = $path;
        }

        $letter = Letters::create([  
            'letter_type_id' => $request->klasifikasi_surat,
            'letter_perihal' => $request->perihal,
            'recipients' => json_encode($request->peserta),
            'content' => $request->isi_surat,
            'attachment' => $attachment,
            'notulis' => $request->notulis,
        ]);

        return redirect()->route('data-surat.preview', $letter->id)->with('success', 'Berhasil menambah data Surat!');
    }

    public function edit($id)
    {
        $letter = Letters::find($id);
        $letterTypes = LetterTypes::get();
        $users = User::where('role', 'guru')->get();       
        return view('data-surat.edit', compact('letter', 'letterTypes', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'klasifikasi_surat' => 'required',
            'perihal' => 'required',
            'peserta' => 'required|array',
            'isi_surat' => 'required',
            'notulis' => 'required',
        ]);

        $suratData = [
            'letter_type_id' => $request->klasifikasi_surat,
            'letter_perihal' => $request->perihal,
            'recipients' => json_encode($request->peserta),
            'content' => $request->isi_surat,
            // 'attachment' => "",
            'notulis' => $request->notulis,
        ];

        Letters::where('id', $id)->update($suratData);
        return redirect()->route('data-surat.index')->with('success', 'Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        Letters::where('id', $id)->delete();
        return redirect()->route('data-surat.index')->with('success', 'Berhasil menghapus data!');
    }

    public function downloadExcel()
    {
        $letters = 'Data Surat.xlsx';
        return Excel::download(new DataSuratFromView, $letters);
    }
}
