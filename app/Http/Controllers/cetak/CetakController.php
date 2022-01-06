<?php

namespace App\Http\Controllers\cetak;

use App\Http\Controllers\Controller;
use Spipu\Html2Pdf\Html2Pdf;

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
}
