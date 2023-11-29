<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Nama User</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Nama Penerima</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Alamat</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Kode Pos</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Kabupaten/Kota</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Provinsi</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">No Hp</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Notes</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Total Produk</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Total Ongkir</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;padding-top: 10px; padding-bottom:10px">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            {{$total_produk = 0}}
            {{$total_ongkir = 0}}
            {{$total_penjualan = 0}}
            @foreach ($data as $dt)
                <tr>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->name }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->nama_penerima }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->alamat }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->zip_code }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->kabupaten_kota }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->provinsi }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->no_hp }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">{{ $dt->order_notes }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">Rp. {{ $dt->total_produk }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">Rp. {{ $dt->total_ongkir }}</td>
                    <td style="color:black;border:1px solid black;text-align: center;vertical-align: middle;">Rp. {{ $dt->paid_total }}</td>
                </tr>
                {{$total_produk += $dt->total_produk}}
                {{$total_ongkir += $dt->total_ongkir}}
                {{$total_penjualan += $dt->paid_total}}
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8" style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;">Total Penjualan</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;">Rp. {{$total_produk}}</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;">Rp. {{$total_ongkir}}</th>
                <th style="background-color:green;
                color:black;border:1px solid black;text-align: center;vertical-align: middle;font-weight:bold;">Rp. {{$total_penjualan}}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
