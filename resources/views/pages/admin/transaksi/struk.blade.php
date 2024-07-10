@extends('layouts.pdf')

@section('title', 'Laporan Transaksi ' . $transaksi->kode_transaksi)

@push('style')
@endpush

@section('main')
    <div>
        <table width="100%" border="0" cellpadding="2.5" cellspacing="0">
            <thead>
                <tr>
                    <td width="20%">Tanggal</td>
                    <td>: {{ $transaksi->created_at }}</td>
                </tr>
                <tr>
                    <td width="20%">Kode Transaksi</td>
                    <td>: {{ $transaksi->kode_transaksi }}</td>
                </tr>
                <tr>
                    <td width="20%">Customer</td>
                    <td>: {{ $transaksi->user->nama }}</td>
                </tr>
                <tr>
                    <td width="20%">Total</td>
                    <td>: {{ formatRupiah($transaksi->total) }}</td>
                </tr>
                <tr>
                    <td width="20%">Status</td>
                    <td>: {!! formatStatusLabel($transaksi->status) !!}</td>
                </tr>
            </thead>
        </table>
        <br>
        <table width="100%" border="1" cellpadding="2.5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody valign="top">
                @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                    <tr>
                        <td align="center">{{ $loop->iteration }}</td>
                        <td>{{ $detailTransaksi->barang->nama }}</td>
                        <td>{{ formatRupiah($detailTransaksi->barang->harga) }}</td>
                        <td>{{ $detailTransaksi->quantity }}</td>
                        <td>{{ formatRupiah($detailTransaksi->jumlah) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total</th>
                    <th>{{ formatRupiah($transaksi->total) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('scripts')
@endpush
