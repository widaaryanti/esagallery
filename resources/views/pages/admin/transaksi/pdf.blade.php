@extends('layouts.pdf')

@section('title', 'Laporan Transaksi ' . $bulanTahun)

@push('style')
@endpush

@section('main')
    <div>
        <table width="100%" border="1" cellpadding="2.5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Tanggal</th>
                    <th>Kode Transaksi</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody valign="top">
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td align ="center">{{ $loop->iteration }}</td>
                        <td>{{ formatTanggal($transaksi->created_at) }}</td>
                        <td>{{ $transaksi->kode_transaksi }}</td>
                        <td>{{ $transaksi->user->nama }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>{{ formatRupiah($transaksi->total) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">Total</th>
                    <th>{{ formatRupiah($transaksis->sum('total')) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@push('scripts')
@endpush
