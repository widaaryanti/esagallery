<?php

use App\Models\Pengaturan;
use App\Models\Transaksi;
use Carbon\Carbon;

if (!function_exists('formatTanggal')) {
    function formatTanggal($tanggal = null, $format = 'l, j F Y')
    {
        $parsedDate = Carbon::parse($tanggal)->locale('id')->settings(['formatFunction' => 'translatedFormat']);
        return $parsedDate->format($format);
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('pengaturan')) {
    function pengaturan()
    {
        return Pengaturan::find(1);
    }
}

if (!function_exists('getKodeTransaksi')) {
    function getKodeTransaksi()
    {
        do {
            $kode = 'ESA-' . date('ymd') . '-' . rand(1000000, 9999999);
            $count = Transaksi::where('kode_transaksi', $kode)->count();
        } while ($count > 0);

        return $kode;

    }
}

if (!function_exists('bulan')) {
    function bulan()
    {
        return [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    }
}

if (!function_exists('formatStatusLabel')) {
    function formatStatusLabel($status)
    {
        $badgeClass = '';
        switch ($status) {
            case 'pending':
                $badgeClass = 'badge bg-warning';
                break;
            case 'disetujui':
                $badgeClass = 'badge bg-success';
                break;
            case 'ditolak':
                $badgeClass = 'badge bg-danger';
                break;
            default:
                $badgeClass = 'badge bg-secondary';
                break;
        }

        return '<span class="' . $badgeClass . ' text-capitalize">' . $status . '</span>';
    }
}