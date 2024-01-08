<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Surat</th>
            <th>Klasifikasi Surat</th>
        </tr>
    </thead>

    <tbody>
        @php($number = 1)
        @foreach ($klasifikasi as $value)
            <tr>
                <td>{{ $number++ }}</td>
                <td>{{ $value->letter_code }}</td>
                <td>{{ $value->name_type }}</td>
            </tr>
        @endforeach
    </tbody>
</table>