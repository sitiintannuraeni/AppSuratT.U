<table class="table">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Nomor Surat</th>
        <th scope="col">Perihal</th>
        <th scope="col">Tanggal Keluar</th>
        <th scope="col">Penerima Surat</th>
        <th scope="col">Notulis</th>
        <th scope="col">Hasil Rapat</th>
    </tr>
    </thead>
    <tbody>
    @php($number = 1)
    @foreach ($letters as $value)
        <tr>
            <td class="align-middle">{{ $number++ }}</td>
            <td class="align-middle">{{ $value->letterTypes->letter_code }}/003/SMK Wikrama/XII/2023</td>
            <td class="align-middle">{{ $value->letter_perihal }}</td>
            <td class="align-middle">{{ $value->created_at->format('d F Y') }}</td>
            <td class="align-middle">
                <ol class="ps-3 mb-0">
                    @php($numberRecipient = 1)
                    @foreach (json_decode($value->recipients) as $recipient)
                        <li>{{$numberRecipient++}}.{{ $recipient }}</li>
                    @endforeach
                </ol>
            </td>
            <td class="align-middle">{{ $value->user->name }}</td>
            <td class="align-middle">
                @if ($value->result)
                    <p class="text-success mb-0">Sudah dibuat</p>
                @else
                    <p class="text-danger mb-0">Belum dibuat</p>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>