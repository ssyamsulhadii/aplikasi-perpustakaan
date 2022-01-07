<?php

namespace App\Http\Controllers\cetak;

use Spipu\Html2Pdf\Html2Pdf;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CetakController extends Controller
{
    public function cetakKategori()
    {
        $kategori_ = \App\Models\Kategori::withCount('buku_')->when(request('rak') ?? false, function ($query, $rak) {
            return $query->WhereHas('rak', function ($query) use ($rak) {
                $query->where('id', $rak);
            });
        })->orderBy('nama')->get();

        $inst_pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [15, 20, 15, 0]);
        // $inst_pdf->previewHTML(view('laporan.cetak.kategori', compact('kategori_')));
        $inst_pdf->pdf->SetTitle('Cetak Data Kategori Buku ' . request('rak'));
        $inst_pdf->writeHTML(view('laporan.cetak.kategori', compact('kategori_')));
        $inst_pdf->output("kategori-buku " . request('rak') . ".pdf");
    }
    public function cetakBuku()
    {
        $buku_ = \App\Models\Buku::when(request('kategori') ?? false, function ($query, $kategori) {
            return $query->WhereHas('kategori', function ($query) use ($kategori) {
                $query->where('id', $kategori);
            });
        })->orderBy('judul')->get();
        $inst_pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [15, 20, 15, 0]);
        // $inst_pdf->previewHTML(view('laporan.cetak.buku', compact('buku_')));
        $inst_pdf->pdf->SetTitle('Cetak Data Buku ' . request('rak') . request('kategori'));
        $inst_pdf->writeHTML(view('laporan.cetak.buku', compact('buku_')));
        $inst_pdf->output("semua-data-buku.pdf");
    }

    public function cetakAnggota()
    {
        $anggota_ = \App\Models\User::where('level', 'anggota')->orderBy('nama')->get();
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 20, 15, 0]);
        $inst_pdf->pdf->SetTitle('Cetak Data Anggota');
        $inst_pdf->writeHTML(view('laporan.cetak.anggota', compact('anggota_')));
        $inst_pdf->output("anggota.pdf");
    }

    public function cetakPeminjaman()
    {
        $tanggal_from =  request('tahun_from') . '-' . request('bulan_from') . '-' . request('tanggal_from');
        $tanggal_to =  request('tahun_to') . '-' . request('bulan_to') . '-' . request('tanggal_to');
        $peminjaman_ = \App\Models\Peminjaman::orderBy('tanggal_pinjam', 'ASC')->whereBetween('tanggal_pinjam', [date($tanggal_from), date($tanggal_to)])->get();
        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 20, 15, 15]);
        $inst_pdf->pdf->SetTitle('Cetak Laporan Peminjaman');
        $inst_pdf->writeHTML(view('laporan.cetak.peminjaman', [
            'peminjaman_' => $peminjaman_,
            'tanggal_from' => new Carbon($tanggal_from),
            'tanggal_to' => new Carbon($tanggal_to),
        ]));
        $inst_pdf->output("cetak-laporan-peminjaman.pdf");
    }
    public function cetakPengembalian()
    {
        $tanggal_from =  request('tahun_from') . '-' . request('bulan_from') . '-' . request('tanggal_from');
        $tanggal_to =  request('tahun_to') . '-' . request('bulan_to') . '-' . request('tanggal_to');
        $pengembalian_ = \App\Models\Pengembalian::WhereHas('peminjaman', function ($query) {
            $query->where('status', 1);
        })->orderBy('tanggal_kembali', 'ASC')->whereBetween('tanggal_kembali', [date($tanggal_from), date($tanggal_to)])->get();

        $inst_pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [15, 20, 15, 15]);
        $inst_pdf->pdf->SetTitle('Cetak Laporan Pengembalian');
        $inst_pdf->writeHTML(view('laporan.cetak.pengembalian', [
            'pengembalian_' => $pengembalian_,
            'tanggal_from' => new Carbon($tanggal_from),
            'tanggal_to' => new Carbon($tanggal_to),
        ]));
        $inst_pdf->output("cetak-laporan-peminjaman.pdf");
    }
}
